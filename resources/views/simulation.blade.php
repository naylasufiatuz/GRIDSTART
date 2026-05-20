<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Grid Start - Simulation</title>
    <style>
        body { margin: 0; overflow: hidden; background-color: #87CEEB; font-family: 'Segoe UI', sans-serif; touch-action: none; }
        canvas { display: block; }
        
        #game-ui { position: absolute; top: 20px; right: 20px; display: flex; gap: 15px; z-index: 10; }
        .hud-box { background: rgba(255, 255, 255, 0.9); padding: 8px 15px; border-radius: 8px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        
        .gas-container { display: flex; align-items: center; gap: 10px; }
        .gas-bar-bg { width: 100px; height: 15px; background: #ccc; border-radius: 10px; overflow: hidden; }
        .gas-bar-fill { height: 100%; background: #2ed573; width: 100%; transition: width 0.2s, background 0.3s; }
        #pause-btn { background: #ff4757; color: white; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-weight: bold; }

        /* Modal Overlay Universal (Glassmorphism) */
        .overlay-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(8px);
            display: none; justify-content: center; align-items: center; z-index: 50;
        }
        .modal-box {
            background: rgba(255, 255, 255, 0.95); padding: 30px; border-radius: 15px;
            width: 90%; max-width: 600px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); text-align: center;
        }
        .modal-box h2 { margin-top: 0; color: #ffaa00; }
        
        /* Modal Start Grid Khusus (Muncul di Awal) */
        #start-overlay { display: flex; z-index: 60; } /* Otomatis flex di awal */
        .btn-action { margin-top: 20px; padding: 12px 30px; background: #2ed573; color: white; border: none; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer; transition: 0.2s; }
        .btn-action:hover { background: #26b360; transform: scale(1.05); }

        /* Timer Pit Stop */
        #timer-container { display: none; width: 100%; height: 10px; background: #eee; border-radius: 5px; margin-top: 15px; overflow: hidden; }
        #timer-bar { height: 100%; width: 100%; background: #ff4757; transition: width 0.1s linear; }

        /* Kuis */
        .quiz-options { display: flex; flex-direction: column; gap: 10px; margin-top: 20px; }
        .quiz-btn { padding: 12px; border: 2px solid #ddd; background: white; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s; text-align: left; }
        .quiz-btn:hover { border-color: #ffaa00; background: #fff8eb; }

        /* Leaderboard Table */
        .leaderboard-table { width: 100%; border-collapse: collapse; margin-top: 15px; text-align: left; }
        .leaderboard-table th, .leaderboard-table td { padding: 10px; border-bottom: 1px solid #eee; }
        .leaderboard-table th { background: #f1f2f6; }

        /* Kontrol Bawah */
        #mobile-controls { position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); display: flex; gap: 20px; z-index: 10; user-select: none; }
        .control-btn { background: rgba(0,0,0,0.4); color: white; border: 2px solid rgba(255,255,255,0.6); border-radius: 50%; width: 60px; height: 60px; font-size: 24px; font-weight: bold; cursor: pointer; display: flex; justify-content: center; align-items: center; backdrop-filter: blur(4px); }
        #btn-brake { border-radius: 20px; width: 90px; font-size: 16px; background: rgba(255,71,87,0.5); }
        .control-btn:active { background: rgba(255,255,255,0.8); color: black; transform: scale(0.95); }
    </style>
</head>
<body>

    <div id="game-ui">
        <div class="hud-box">Jarak: <span id="distance-ui">0</span>m</div>
        <div class="hud-box">Poin: <span id="score-ui">0</span></div>
        <div class="hud-box gas-container">
            Bensin: 
            <div class="gas-bar-bg"><div class="gas-bar-fill" id="gas-fill"></div></div>
        </div>
        <button id="pause-btn">PAUSE</button>
    </div>

    <div id="start-overlay" class="overlay-bg">
        <div class="modal-box">
            <h2 style="color: #2ed573;">🏁 START GRID</h2>
            <p><strong>Pengenalan Keselamatan Berkendara</strong></p>
            <p>Start Grid adalah titik awal sebelum balapan dimulai. Di tahap ini, kamu harus siap secara mental dan memahami prinsip dasar keselamatan berkendara (Safety First).<br><br>Hindari kelalaian, dan selalu utamakan keselamatan di atas kecepatan!</p>
            <button id="btn-start-game" class="btn-action">TANCAP GAS!</button>
        </div>
    </div>

    <div id="quiz-overlay" class="overlay-bg">
        <div class="modal-box">
            <h2 id="quiz-title">Title Placeholder</h2>
            <p id="quiz-question">Question Placeholder</p>
            <div id="timer-container"><div id="timer-bar"></div></div>
            <div class="quiz-options">
                <button class="quiz-btn" id="btn-opt-a">A</button>
                <button class="quiz-btn" id="btn-opt-b">B</button>
                <button class="quiz-btn" id="btn-opt-c">C</button>
            </div>
        </div>
    </div>

    <div id="finish-overlay" class="overlay-bg">
        <div class="modal-box" style="max-width: 650px;">
            <h2 style="color: #2ed573;">🏁 FINISH LINE ACCESSED!</h2>
            <p>Selamat! Kamu telah menyelesaikan simulasi berkendara dengan sukses.</p>
            <h3>Total Poin Diperoleh: <span id="final-score" style="color: #ffaa00; font-size: 28px;">0</span></h3>
            
            <h3 style="text-align: left; margin-top: 20px;">🏆 Papan Peringkat (Leaderboard)</h3>
            <table class="leaderboard-table">
                <thead>
                    <tr><th>Posisi</th><th>Username</th><th>Total Poin</th><th>Terakhir Main</th></tr>
                </thead>
                <tbody>
                    <tr><td><b>1</b></td><td>admin</td><td>120</td><td>Barusan</td></tr>
                    <tr><td><b>2</b></td><td>max</td><td>95</td><td>2026-04-01</td></tr>
                    <tr><td><b>3</b></td><td>lando</td><td>80</td><td>2026-04-01</td></tr>
                </tbody>
            </table>
            <button id="close-finish-btn" class="btn-action">Selesai & Keluar</button>
        </div>
    </div>

    <div id="mobile-controls">
        <button id="btn-left" class="control-btn">◀</button>
        <button id="btn-brake" class="control-btn">REM</button>
        <button id="btn-right" class="control-btn">▶</button>
    </div>

    <script type="importmap">
        { "imports": { "three": "https://unpkg.com/three@0.160.0/build/three.module.js" } }
    </script>

    <script type="module">
        import * as THREE from 'three';

        // Setup Dasar Three.js
        const scene = new THREE.Scene();
        scene.fog = new THREE.Fog(0x87CEEB, 10, 50); 
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.set(0, 3, 7); camera.lookAt(0, 0, -10);

        const renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        const ambientLight = new THREE.AmbientLight(0xffffff, 0.6); scene.add(ambientLight);
        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8); directionalLight.position.set(10, 20, 10); scene.add(directionalLight);

        // Jalanan
        const road = new THREE.GridHelper(40, 40, 0x555555, 0xaaaaaa); road.position.y = 0; scene.add(road);
        
        // Garis Finish (Visual Aspal Kotak-Kotak)
        const canvas = document.createElement('canvas'); canvas.width = 128; canvas.height = 128;
        const ctx = canvas.getContext('2d');
        ctx.fillStyle = '#ffffff'; ctx.fillRect(0,0,128,128); // Background Putih
        ctx.fillStyle = '#111111'; ctx.fillRect(0,0,64,64); ctx.fillRect(64,64,64,64); // Kotak Hitam
        const finishTexture = new THREE.CanvasTexture(canvas);
        finishTexture.wrapS = THREE.RepeatWrapping; finishTexture.wrapT = THREE.RepeatWrapping;
        finishTexture.repeat.set(10, 3);
        
        const finishMat = new THREE.MeshStandardMaterial({ map: finishTexture });
        const finishMesh = new THREE.Mesh(new THREE.PlaneGeometry(16, 4), finishMat);
        finishMesh.rotation.x = -Math.PI / 2;
        finishMesh.position.set(0, 0.02, -100); // Disembunyikan jauh di belakang dulu
        scene.add(finishMesh);

        // Mobil
        const carGeometry = new THREE.BoxGeometry(1.5, 1, 3);
        const carMaterial = new THREE.MeshStandardMaterial({ color: 0xff3333 });
        const car = new THREE.Mesh(carGeometry, carMaterial);
        car.position.set(0, 0.5, 0); scene.add(car);

        // State Game Utama
        let speed = 0.5; 
        let isPaused = true; // GAME LANGSUNG PAUSE DI AWAL KARENA ADA START GRID
        let distance = 0;
        let score = 0;
        let gas = 100;
        
        let isGameOver = false;
        let hasHitFinishLine = false;
        let hasDonePitStop = false; // Flag bensin 1 kali habis

        // Tombol Start Grid
        document.getElementById('btn-start-game').addEventListener('click', () => {
            document.getElementById('start-overlay').style.display = 'none';
            isPaused = false; // Mobil mulai jalan!
        });

        const keys = { ArrowLeft: false, ArrowRight: false, ArrowDown: false };
        window.addEventListener('keydown', (e) => { 
            if(e.key === 'ArrowLeft' || e.code === 'ArrowLeft') keys.ArrowLeft = true;
            if(e.key === 'ArrowRight' || e.code === 'ArrowRight') keys.ArrowRight = true;
            if(e.key === 'ArrowDown' || e.code === 'ArrowDown') keys.ArrowDown = true;
        });
        window.addEventListener('keyup', (e) => { 
            if(e.key === 'ArrowLeft' || e.code === 'ArrowLeft') keys.ArrowLeft = false;
            if(e.key === 'ArrowRight' || e.code === 'ArrowRight') keys.ArrowRight = false;
            if(e.key === 'ArrowDown' || e.code === 'ArrowDown') keys.ArrowDown = false;
        });
        
        const setupButton = (id, keyName) => {
            const btn = document.getElementById(id);
            btn.addEventListener('touchstart', (e) => { e.preventDefault(); keys[keyName] = true; });
            btn.addEventListener('touchend', (e) => { e.preventDefault(); keys[keyName] = false; });
            btn.addEventListener('mousedown', () => { keys[keyName] = true; });
            btn.addEventListener('mouseup', () => { keys[keyName] = false; });
            btn.addEventListener('mouseleave', () => { keys[keyName] = false; });
        };
        setupButton('btn-left', 'ArrowLeft'); setupButton('btn-right', 'ArrowRight'); setupButton('btn-brake', 'ArrowDown');

        // ==========================================
        // DATA KUIS & LOGIKA PIT STOP
        // ==========================================
        let currentActiveQuizMode = ''; 
        
        const articleQuizzes = [
            { triggerDistance: 200, title: "⚠️ YELLOW FLAG", question: "Ada scene kecelakaan di bagian kiri jalan. Apa tindakan antisipasi terbaikmu sesuai aturan?", answers: [{ text: "A. Tetap melaju maksimal sambil membunyikan klakson panjang", correct: false }, { text: "B. Menurunkan kecepatan dan berhati-hati menghindari kecelakaan tersebut", correct: true }, { text: "C. Menambah kecepatan di lajur kanan agar cepat menjauh", correct: false }], triggered: false },
            { triggerDistance: 500, title: "🛣️ RACING LINE", question: "Kondisi lalu lintas sedang sangat padat di lajur kanan jalan. Langkah apa yang aman dilakukan?", answers: [{ text: "A. Berganti arah lajur ke kiri/tengah yang kosong dan menambah kecepatan aman", correct: true }, { text: "B. Tetap memaksakan masuk lajur kanan yang padat agar stabil", correct: false }, { text: "C. Langsung mengerem mendadak di lajur kanan hingga berhenti total", correct: false }], triggered: false },
            { triggerDistance: 800, title: "🛑 BRAKE ZONE", question: "Ada jalanan rusak parah di bagian kanan lintasan. Bagaimana teknik pengereman yang tepat?", answers: [{ text: "A. Melaju berliku-liku menghindari lubang tanpa mengerem", correct: false }, { text: "B. Menarik rem tangan secara mendadak saat tepat di atas lubang", correct: false }, { text: "C. Mengerem bertahap jauh sebelum titik lubang dan berhati-hati menghindarinya", correct: true }], triggered: false }
        ];

        const pitStopQuestions = [
            { question: "(1/3) Fungsi utama dari oli mesin kendaraan adalah...", answers: [{ text: "A. Mendinginkan suhu AC dalam kabin", correct: false }, { text: "B. Melumasi komponen internal mesin agar mengurangi gesekan", correct: true }, { text: "C. Mengubah putaran roda menjadi tenaga listrik", correct: false }] },
            { question: "(2/3) Jika lampu indikator temperatur di dashboard menyala merah, artinya...", answers: [{ text: "A. Mesin mengalami overheat (panas berlebih)", correct: true }, { text: "B. Tangki bahan bakar bocor parah", correct: false }, { text: "C. Tekanan udara semua ban menurun", correct: false }] },
            { question: "(3/3) Cairan yang direkomendasikan untuk wiper kaca depan adalah...", answers: [{ text: "A. Air Accu / Aki zuur", correct: false }, { text: "B. Air bersih khusus wiper / washer fluid", correct: true }, { text: "C. Air mineral dicampur deterjen bubuk", correct: false }] }
        ];

        let currentPitStopIndex = 0;
        let pitStopTimerInterval;
        let timeLeft = 100; 

        const quizOverlay = document.getElementById('quiz-overlay');
        const quizButtons = document.querySelectorAll('.quiz-btn');
        const timerContainer = document.getElementById('timer-container');
        const timerBar = document.getElementById('timer-bar');

        function showArticleQuiz(quizObj) {
            currentActiveQuizMode = 'article'; isPaused = true; quizObj.triggered = true;
            timerContainer.style.display = 'none'; 
            document.getElementById('quiz-title').innerText = quizObj.title;
            document.getElementById('quiz-question').innerText = quizObj.question;
            quizButtons.forEach((btn, index) => {
                btn.innerText = quizObj.answers[index].text;
                btn.setAttribute('data-correct', quizObj.answers[index].correct);
            });
            quizOverlay.style.display = 'flex';
        }

        function startPitStop() {
            currentActiveQuizMode = 'pitstop'; isPaused = true; hasDonePitStop = true; currentPitStopIndex = 0;
            quizOverlay.style.display = 'flex';
            loadPitStopQuestion();
        }

        function loadPitStopQuestion() {
            clearInterval(pitStopTimerInterval); timeLeft = 100; timerBar.style.width = "100%";
            timerContainer.style.display = 'block'; 
            const qData = pitStopQuestions[currentPitStopIndex];
            document.getElementById('quiz-title').innerText = "⛽ PIT STOP (WAKTU TERBATAS!)";
            document.getElementById('quiz-question').innerText = qData.question;
            quizButtons.forEach((btn, index) => {
                btn.innerText = qData.answers[index].text;
                btn.setAttribute('data-correct', qData.answers[index].correct);
            });

            pitStopTimerInterval = setInterval(() => {
                timeLeft -= 1.5; timerBar.style.width = timeLeft + "%";
                if(timeLeft <= 0) { clearInterval(pitStopTimerInterval); handlePitStopAnswer(false); }
            }, 100);
        }

        function handlePitStopAnswer(isCorrect) {
            clearInterval(pitStopTimerInterval);
            if(isCorrect) { gas += 34; if(gas > 100) gas = 100; alert("Benar! Bensin bertambah +1 bar."); } 
            else { alert("Salah / Waktu Habis! 0 bensin didapat dari soal ini."); }

            currentPitStopIndex++;
            if(currentPitStopIndex < pitStopQuestions.length) { loadPitStopQuestion(); } 
            else {
                quizOverlay.style.display = 'none'; currentActiveQuizMode = '';
                if(gas <= 0) { isGameOver = true; alert("PIT STOP SELESAI. Bensin kamu tetap 0%. GAME OVER!"); } 
                else { alert("PIT STOP SELESAI. Tangki terisi. Lanjutkan berkendara!"); isPaused = false; }
            }
        }

        quizButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const isCorrect = e.target.getAttribute('data-correct') === 'true';
                if (currentActiveQuizMode === 'article') {
                    if(isCorrect) { score += 10; alert("Benar! Poin bertambah +10."); } 
                    else { score -= 10; alert("Salah! Penalti poin -10."); }
                    document.getElementById('score-ui').innerText = score;
                    quizOverlay.style.display = 'none'; currentActiveQuizMode = ''; isPaused = false;
                } 
                else if (currentActiveQuizMode === 'pitstop') { handlePitStopAnswer(isCorrect); }
            });
        });

        // Loop Render Utama
        function animate() {
            requestAnimationFrame(animate);

            if (!isPaused && !isGameOver && !hasHitFinishLine) {
                // Pergerakan jalan
                road.position.z += speed;
                if (road.position.z > 1) road.position.z = 0;

                distance += (speed * 0.2); 
                let currentDistance = Math.floor(distance);
                document.getElementById('distance-ui').innerText = currentDistance;

                // ==========================================
                // LOGIKA BENSIN (HABIS PERSIS DI JARAK 650M)
                // ==========================================
                if (!hasDonePitStop) {
                    // Rumus ini menjamin bensin akan persis menyentuh 0% saat jarak mencapai 650
                    gas = 100 - (distance / 650) * 100;
                    if(gas <= 0) {
                        gas = 0; 
                        startPitStop(); // TRIGGER PIT STOP!
                    }
                } else {
                    // Setelah lewat pitstop, bensin tetap berkurang tapi sangat pelan, 
                    // dijamin tidak akan habis sebelum garis finish.
                    gas -= 0.01; 
                }
                
                // Update UI Bensin
                const gasFill = document.getElementById('gas-fill');
                gasFill.style.width = gas + "%";
                if(gas < 30) gasFill.style.background = "#ff4757"; 
                else gasFill.style.background = "#2ed573"; 

                // TRIGGER KUIS ARTIKEL
                articleQuizzes.forEach(quiz => {
                    if (currentDistance === quiz.triggerDistance && !quiz.triggered) { showArticleQuiz(quiz); }
                });

                // ==========================================
                // LOGIKA FINISH LINE VISUAL
                // ==========================================
                if (distance >= 850 && distance < 1000) {
                    // Hitung sisa jarak dan sinkronkan dengan posisi Z dari visual aspal kotak-kotak
                    let remainingDistance = 1000 - distance;
                    // Kalikan 5 agar pergerakan visualnya cocok dengan laju kecepatan jalan (speed 0.5 vs speed*0.2)
                    finishMesh.position.z = -(remainingDistance * 5); 
                }

                if (currentDistance >= 1000) {
                    hasHitFinishLine = true;
                    isPaused = true;
                    document.getElementById('final-score').innerText = score;
                    document.getElementById('finish-overlay').style.display = 'flex';
                }

                // Kontrol Mobil
                const turnSpeed = 0.15;
                if (keys.ArrowLeft && car.position.x > -4) car.position.x -= turnSpeed;
                if (keys.ArrowRight && car.position.x < 4) car.position.x += turnSpeed;
                if (keys.ArrowDown) road.position.z -= (speed * 0.6); 
            }
            renderer.render(scene, camera);
        }

        animate();

        window.addEventListener('resize', () => { renderer.setSize(window.innerWidth, window.innerHeight); camera.aspect = window.innerWidth / window.innerHeight; camera.updateProjectionMatrix(); });
        
        document.getElementById('pause-btn').addEventListener('click', () => { 
            // Tidak bisa dipause saat kuis atau finish atau start grid
            const isAnyModalOpen = document.getElementById('quiz-overlay').style.display === 'flex' || 
                                   document.getElementById('finish-overlay').style.display === 'flex' ||
                                   document.getElementById('start-overlay').style.display === 'flex';
            if(!isGameOver && !hasHitFinishLine && !isAnyModalOpen) { 
                isPaused = !isPaused; 
                document.getElementById('pause-btn').innerText = isPaused ? "RESUME" : "PAUSE"; 
            } 
        });

        document.getElementById('close-finish-btn').addEventListener('click', () => {
            document.getElementById('finish-overlay').style.display = 'none';
            window.location.href = '/leaderboard'; 
        });

    </script>
</body>
</html>