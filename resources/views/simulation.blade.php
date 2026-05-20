<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Grid Start - Simulation</title>
    <style>
        body { 
            margin: 0; 
            overflow: hidden; 
            background-color: #87CEEB; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            touch-action: none; 
        }
        canvas { display: block; }
        
        /* HUD Atas */
        #game-ui {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 15px;
            z-index: 10;
        }
        .hud-box {
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        /* Progress Bar Bensin */
        .gas-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .gas-bar-bg {
            width: 100px;
            height: 15px;
            background: #ccc;
            border-radius: 10px;
            overflow: hidden;
        }
        .gas-bar-fill {
            height: 100%;
            background: #2ed573;
            width: 100%;
            transition: width 0.2s, background 0.3s;
        }

        #pause-btn {
            background: #ff4757;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        /* Modal Pop-up Kuis (Glassmorphism style) */
        #quiz-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            display: none; /* Disembunyikan dulu */
            justify-content: center;
            align-items: center;
            z-index: 50;
        }
        .quiz-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            text-align: center;
        }
        .quiz-box h2 {
            margin-top: 0;
            color: #ffaa00; /* Warna Yellow Flag */
        }
        .quiz-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }
        .quiz-btn {
            padding: 12px;
            border: 2px solid #ddd;
            background: white;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            text-align: left;
        }
        .quiz-btn:hover {
            border-color: #ffaa00;
            background: #fff8eb;
        }

        /* Kontrol Bawah */
        #mobile-controls {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 20px;
            z-index: 10;
            user-select: none; 
        }
        .control-btn {
            background: rgba(0, 0, 0, 0.4);
            color: white;
            border: 2px solid rgba(255,255,255,0.6);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }
        #btn-brake {
            border-radius: 20px;
            width: 90px;
            font-size: 16px;
            background: rgba(255, 71, 87, 0.5); 
        }
        .control-btn:active {
            background: rgba(255, 255, 255, 0.8);
            color: black;
            transform: scale(0.95); 
        }
    </style>
</head>
<body>

    <div id="game-ui">
        <div class="hud-box">Jarak: <span id="distance-ui">0</span>m</div>
        <div class="hud-box">Poin: <span id="score-ui">0</span></div>
        <div class="hud-box gas-container">
            Bensin: 
            <div class="gas-bar-bg">
                <div class="gas-bar-fill" id="gas-fill"></div>
            </div>
        </div>
        <button id="pause-btn">PAUSE</button>
    </div>

    <div id="quiz-overlay">
        <div class="quiz-box">
            <h2 id="quiz-title">⚠️ YELLOW FLAG!</h2>
            <p id="quiz-question">Ada kecelakaan di bagian kiri jalan. Apa yang harus kamu lakukan sesuai prinsip Safety First?</p>
            <div class="quiz-options">
                <button class="quiz-btn" data-correct="false">A. Tetap di kecepatan maksimal dan membunyikan klakson</button>
                <button class="quiz-btn" data-correct="true">B. Menurunkan kecepatan dan berhati-hati menghindari kecelakaan</button>
                <button class="quiz-btn" data-correct="false">C. Menutup mata dan berdoa</button>
            </div>
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

        // ... [Setup Three.js sama seperti sebelumnya] ...
        const scene = new THREE.Scene();
        scene.fog = new THREE.Fog(0x87CEEB, 10, 50); 
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.set(0, 3, 7); 
        camera.lookAt(0, 0, -10);

        const renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        const ambientLight = new THREE.AmbientLight(0xffffff, 0.6); scene.add(ambientLight);
        const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8); directionalLight.position.set(10, 20, 10); scene.add(directionalLight);

        const road = new THREE.GridHelper(40, 40, 0x555555, 0xaaaaaa); road.position.y = 0; scene.add(road);
        
        const carGeometry = new THREE.BoxGeometry(1.5, 1, 3);
        const carMaterial = new THREE.MeshStandardMaterial({ color: 0xff3333 });
        const car = new THREE.Mesh(carGeometry, carMaterial);
        car.position.set(0, 0.5, 0); scene.add(car);

        // -- VARIABEL GAME LOGIC --
        let speed = 0.5; 
        let isPaused = false;
        
        // Status Game
        let distance = 0;
        let score = 0;
        let gas = 100;
        let isGameOver = false;

        // Trigger Event (Supaya pop-up kuis cuma muncul sekali di jarak tertentu)
        let hasTriggeredYellowFlag = false;

        const keys = { ArrowLeft: false, ArrowRight: false, ArrowDown: false };

        // Kontrol Input
        window.addEventListener('keydown', (e) => { if(keys.hasOwnProperty(e.code)) keys[e.code] = true; });
        window.addEventListener('keyup', (e) => { if(keys.hasOwnProperty(e.code)) keys[e.code] = false; });
        
        const setupButton = (id, keyName) => {
            const btn = document.getElementById(id);
            btn.addEventListener('touchstart', (e) => { e.preventDefault(); keys[keyName] = true; });
            btn.addEventListener('touchend', (e) => { e.preventDefault(); keys[keyName] = false; });
            btn.addEventListener('mousedown', () => { keys[keyName] = true; });
            btn.addEventListener('mouseup', () => { keys[keyName] = false; });
            btn.addEventListener('mouseleave', () => { keys[keyName] = false; });
        };
        setupButton('btn-left', 'ArrowLeft'); setupButton('btn-right', 'ArrowRight'); setupButton('btn-brake', 'ArrowDown');

        // -- LOGIKA KUIS (Menjawab Pop-up) --
        const quizOverlay = document.getElementById('quiz-overlay');
        const quizButtons = document.querySelectorAll('.quiz-btn');

        quizButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const isCorrect = e.target.getAttribute('data-correct') === 'true';
                
                if(isCorrect) {
                    score += 10; // Poin plus
                    alert("Benar! +10 Poin. Melanjutkan perjalanan...");
                } else {
                    score -= 10; // Poin minus
                    alert("Salah! -10 Poin. Hati-hati di jalan!");
                }
                
                // Update UI Score
                document.getElementById('score-ui').innerText = score;
                
                // Tutup modal dan lanjut jalan
                quizOverlay.style.display = 'none';
                isPaused = false;
            });
        });

        // 6. RENDER LOOP
        function animate() {
            requestAnimationFrame(animate);

            if (!isPaused && !isGameOver) {
                // Ilusi Maju
                road.position.z += speed;
                if (road.position.z > 1) road.position.z = 0;

                // Hitung Jarak & Bensin
                distance += (speed * 0.2); // Kalkulasi jarak fiktif
                document.getElementById('distance-ui').innerText = Math.floor(distance);

                gas -= 0.03; // Pengeluaran bensin (pelan-pelan)
                if(gas <= 0) gas = 0;
                
                // Update UI Bensin
                const gasFill = document.getElementById('gas-fill');
                gasFill.style.width = gas + "%";
                if(gas < 30) gasFill.style.background = "#ff4757"; // Berubah merah kalau mau habis
                else gasFill.style.background = "#2ed573"; // Hijau kalau aman

                // Cek Game Over bensin
                if(gas === 0) {
                    isGameOver = true;
                    alert("Bensin Habis! GAME OVER.");
                }

                // --- LOGIKA MUNCUL KUIS YELLOW FLAG ---
                // Jika jarak mencapai 150 meter dan belum pernah memunculkan Yellow Flag
                if (Math.floor(distance) === 150 && !hasTriggeredYellowFlag) {
                    isPaused = true; // Hentikan mobil
                    hasTriggeredYellowFlag = true; // Tandai sudah trigger
                    quizOverlay.style.display = 'flex'; // Munculkan pop-up
                }

                // Pergerakan Mobil (Kiri/Kanan/Rem)
                const turnSpeed = 0.15;
                if (keys.ArrowLeft && car.position.x > -4) car.position.x -= turnSpeed;
                if (keys.ArrowRight && car.position.x < 4) car.position.x += turnSpeed;
                if (keys.ArrowDown) road.position.z -= (speed * 0.6); 
            }
            renderer.render(scene, camera);
        }

        animate();

        window.addEventListener('resize', () => {
            renderer.setSize(window.innerWidth, window.innerHeight);
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
        });

        document.getElementById('pause-btn').addEventListener('click', () => {
            if(!isGameOver && quizOverlay.style.display !== 'flex') {
                isPaused = !isPaused;
                document.getElementById('pause-btn').innerText = isPaused ? "RESUME" : "PAUSE";
            }
        });

    </script>
</body>
</html>