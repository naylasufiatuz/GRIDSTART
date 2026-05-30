<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Grid Start - Pro Simulation</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/simulation.css') }}">
</head>
<body>

    <div id="toast-container"></div>

    <div id="hud-panel">
        <div class="hud-item">Jarak <span class="hud-value"><span id="distance-ui">0</span>m</span></div>
        <div class="hud-item">Poin <span class="hud-value" id="score-ui">0</span></div>
        <div style="margin-top: 15px; font-size: 14px; font-weight: 600;">Bensin</div>
        <div class="gas-bar-container"><div class="gas-bar-fill" id="gas-fill"></div></div>
    </div>

    <div id="action-panel">
        <div class="circle-btn" id="pause-btn">⏸</div>
    </div>

    <div id="d-pad">
        <div class="d-btn" id="btn-up">↑</div>
        <div class="d-btn" id="btn-left">←</div>
        <div class="d-btn" id="btn-brake">REM</div>
        <div class="d-btn" id="btn-right">→</div>
    </div>

    <div id="start-overlay" class="overlay-bg">
        <div class="modal-card">
            <h2>START GRID</h2>
            <p><strong>Pengenalan Keselamatan Berkendara</strong><br><br>Persiapkan mental dan pahami prinsip <em>Safety First</em>. Hindari kelalaian, dan selalu utamakan keselamatan di atas kecepatan!</p>
            <button id="btn-start-game" class="btn-primary">UDAH SIAP? AYO GAS!</button>
        </div>
    </div>

    <div id="quiz-overlay" class="overlay-bg">
        <div class="modal-card">
            <h2 id="quiz-title">Peringatan!</h2>
            <p id="quiz-question">Pertanyaan akan muncul di sini.</p>
            <div id="timer-bar-wrap"><div id="timer-bar-fill"></div></div>
            <div class="quiz-opts">
                <button class="quiz-btn" id="btn-opt-a">A</button>
                <button class="quiz-btn" id="btn-opt-b">B</button>
                <button class="quiz-btn" id="btn-opt-c">C</button>
            </div>
        </div>
    </div>

    <div id="finish-overlay" class="overlay-bg">
        <div class="modal-card">
            <h2 style="color: var(--accent-green);">FINISH LINE!</h2>
            <p>Simulasi berkendara telah selesai dengan sukses.</p>
            <div style="font-size: 18px; color: #636e72; margin: 20px 0;">Total Poin</div>
            <div style="font-size: 48px; font-weight: 800; color: var(--accent-yellow); margin-bottom: 20px;" id="final-score">0</div>
            <p id="saving-status" style="font-style: italic; font-size: 14px;">Menyimpan skor ke server...</p>
            <button id="close-finish-btn" class="btn-primary" style="display: none; width: 100%; margin-top:15px;">Lanjutkan</button>
        </div>
    </div>

    <script type="importmap">
        { "imports": { "three": "https://unpkg.com/three@0.160.0/build/three.module.js" } }
    </script>

    <script type="module">
        import * as THREE from 'three';

        // ==========================================
        // 0. FUNGSI CUSTOM TOAST (Pengganti Alert)
        // ==========================================
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = message;
            container.appendChild(toast);
            
            // Animasi masuk
            setTimeout(() => { toast.classList.add('show'); }, 10);
            
            // Animasi hilang & hapus elemen setelah 3 detik
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ==========================================
        // 1. SETUP SCENE, CAMERA, RENDERER
        // ==========================================
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0xd7f0f5);
        scene.fog = new THREE.Fog(0xd7f0f5, 20, 150); 

        const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 300);
        camera.position.set(0, 4, 10); 
        camera.lookAt(0, 0, -10);

        const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.shadowMap.enabled = true; 
        renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        document.body.appendChild(renderer.domElement);

        // ==========================================
        // 2. LIGHTING 
        // ==========================================
        const hemiLight = new THREE.HemisphereLight(0xffffff, 0xc8e6c9, 0.6);
        scene.add(hemiLight);

        const dirLight = new THREE.DirectionalLight(0xffeaa7, 0.8);
        dirLight.position.set(50, 100, 50);
        dirLight.castShadow = true;
        dirLight.shadow.camera.top = 100; dirLight.shadow.camera.bottom = -100;
        dirLight.shadow.camera.left = -100; dirLight.shadow.camera.right = 100;
        dirLight.shadow.mapSize.width = 2048; dirLight.shadow.mapSize.height = 2048;
        scene.add(dirLight);

        // ==========================================
        // 3. GENERATOR MOBIL REALISTIS & LINGKUNGAN
        // ==========================================
        const matGround = new THREE.MeshStandardMaterial({ color: 0xe1f2e3, flatShading: true }); 
        const matRoad = new THREE.MeshStandardMaterial({ color: 0x95a5a6, roughness: 0.9 });
        const matLine = new THREE.MeshBasicMaterial({ color: 0xffffff });
        const matWood = new THREE.MeshStandardMaterial({ color: 0x8b5a2b, flatShading: true });
        const matLeaves = new THREE.MeshStandardMaterial({ color: 0x55efc4, flatShading: true });
        
        // Material Mobil
        const matGlass = new THREE.MeshStandardMaterial({ color: 0x222222, roughness: 0.1, metalness: 0.8 });
        const matDark = new THREE.MeshStandardMaterial({ color: 0x111111, roughness: 0.9 });
        const matHeadlight = new THREE.MeshBasicMaterial({ color: 0xffffff });
        const matTaillight = new THREE.MeshBasicMaterial({ color: 0xff4757 });

        const ground = new THREE.Mesh(new THREE.PlaneGeometry(500, 500), matGround);
        ground.rotation.x = -Math.PI / 2; ground.receiveShadow = true; scene.add(ground);

        const road = new THREE.Mesh(new THREE.PlaneGeometry(12, 500), matRoad);
        road.rotation.x = -Math.PI / 2; road.position.y = 0.01; road.receiveShadow = true; scene.add(road);

        // Desain Mobil Baru (Sleek Sports Car)
        function createRealisticCar(primaryColorHex) {
            const car = new THREE.Group();
            const matBody = new THREE.MeshStandardMaterial({ color: primaryColorHex, roughness: 0.4, metalness: 0.5, flatShading:true });

            // Chassis Bawah (Lebih panjang & ceper)
            const chassis = new THREE.Mesh(new THREE.BoxGeometry(2.2, 0.4, 4.8), matBody);
            chassis.position.y = 0.4; chassis.castShadow = true;
            car.add(chassis);

            // Kabin (Melengkung aerodinamis)
            const cabin = new THREE.Mesh(new THREE.BoxGeometry(1.6, 0.5, 2.2), matGlass);
            cabin.position.set(0, 0.85, -0.2); cabin.castShadow = true;
            car.add(cabin);

            // Spoiler Belakang (Sayap mobil balap)
            const pillarL = new THREE.Mesh(new THREE.BoxGeometry(0.1, 0.3, 0.2), matDark);
            pillarL.position.set(-0.8, 0.7, 2.2);
            const pillarR = new THREE.Mesh(new THREE.BoxGeometry(0.1, 0.3, 0.2), matDark);
            pillarR.position.set(0.8, 0.7, 2.2);
            const spoilerWing = new THREE.Mesh(new THREE.BoxGeometry(2.0, 0.1, 0.4), matBody);
            spoilerWing.position.set(0, 0.9, 2.3); spoilerWing.castShadow = true;
            car.add(pillarL, pillarR, spoilerWing);

            // Lampu Depan & Belakang
            const hlL = new THREE.Mesh(new THREE.BoxGeometry(0.4, 0.1, 0.1), matHeadlight); hlL.position.set(-0.7, 0.5, -2.4);
            const hlR = new THREE.Mesh(new THREE.BoxGeometry(0.4, 0.1, 0.1), matHeadlight); hlR.position.set(0.7, 0.5, -2.4);
            const tlL = new THREE.Mesh(new THREE.BoxGeometry(0.5, 0.1, 0.1), matTaillight); tlL.position.set(-0.7, 0.5, 2.4);
            const tlR = new THREE.Mesh(new THREE.BoxGeometry(0.5, 0.1, 0.1), matTaillight); tlR.position.set(0.7, 0.5, 2.4);
            car.add(hlL, hlR, tlL, tlR);

            // 4 Ban Lebar
            const wheelGeo = new THREE.CylinderGeometry(0.4, 0.4, 0.4, 16); wheelGeo.rotateZ(Math.PI / 2);
            [[-1.1, 0.4, 1.4], [1.1, 0.4, 1.4], [-1.1, 0.4, -1.4], [1.1, 0.4, -1.4]].forEach(pos => {
                const wheel = new THREE.Mesh(wheelGeo, matDark);
                wheel.position.set(...pos); wheel.castShadow = true; car.add(wheel);
            });
            return car;
        }

        // Spawn Mobil Player (Merah)
        const playerCar = createRealisticCar(0xff4757);
        scene.add(playerCar);

        function createLowPolyTree() {
            const tree = new THREE.Group();
            const trunk = new THREE.Mesh(new THREE.CylinderGeometry(0.2, 0.3, 1.5, 5), matWood);
            trunk.position.y = 0.75; trunk.castShadow = true;
            const leaves = new THREE.Mesh(new THREE.IcosahedronGeometry(1.2, 0), matLeaves);
            leaves.position.y = 2; leaves.castShadow = true;
            tree.add(trunk); tree.add(leaves); return tree;
        }

        function createLampPost() {
            const lamp = new THREE.Group();
            const pole = new THREE.Mesh(new THREE.CylinderGeometry(0.1, 0.1, 4, 8), matDark);
            pole.position.y = 2; pole.castShadow = true;
            const top = new THREE.Mesh(new THREE.BoxGeometry(1.5, 0.2, 0.3), matDark);
            top.position.set(0.6, 4, 0); top.castShadow = true;
            const bulb = new THREE.Mesh(new THREE.SphereGeometry(0.15, 8, 8), new THREE.MeshBasicMaterial({color: 0xffeaa7}));
            bulb.position.set(1.2, 3.9, 0);
            lamp.add(pole); lamp.add(top); lamp.add(bulb); return lamp;
        }

        let worldObjects = [];
        let fireParticles = []; // Array untuk efek api kecelakaan

        function spawnEnvironment() {
            const line = new THREE.Mesh(new THREE.PlaneGeometry(0.2, 2), matLine);
            line.rotation.x = -Math.PI / 2; line.position.set(0, 0.02, -150);
            scene.add(line); worldObjects.push(line);

            if(Math.random() > 0.3) { const treeL = createLowPolyTree(); treeL.position.set(-8 - Math.random()*10, 0, -150); scene.add(treeL); worldObjects.push(treeL); }
            if(Math.random() > 0.3) { const treeR = createLowPolyTree(); treeR.position.set(8 + Math.random()*10, 0, -150); scene.add(treeR); worldObjects.push(treeR); }
            if(Math.random() > 0.8) { const lamp = createLampPost(); lamp.position.set(-6.5, 0, -150); scene.add(lamp); worldObjects.push(lamp); }
        }

        // ==========================================
        // 4. SKENARIO OBJEK KHUSUS (DRAMATIS & REALISTIS)
        // ==========================================
        function createAccident() {
            const group = new THREE.Group();
            
            // Mobil 1: Terguling / Terbalik
            const car1 = createRealisticCar(0x0984e3); // Biru
            car1.rotation.z = Math.PI; // Terbalik 180 derajat
            car1.rotation.y = Math.PI/6;
            car1.position.set(-2, 0.8, 0); 
            
            // Mobil 2: Menabrak dari samping
            const car2 = createRealisticCar(0x2d3436); // Hitam
            car2.rotation.y = -Math.PI/4;
            car2.position.set(-3.5, 0, 3);
            
            group.add(car1, car2);

            // PARTICLE SYSTEM API & ASAP (FIRE EFFECT)
            const fireGeo = new THREE.TetrahedronGeometry(0.5);
            const fireMat = new THREE.MeshBasicMaterial({ color: 0xff7675, transparent: true, opacity: 0.8 });
            for(let i=0; i<40; i++) {
                const p = new THREE.Mesh(fireGeo, fireMat.clone());
                p.position.set(-2.5 + (Math.random()-0.5)*2, Math.random()*2, 1.5 + (Math.random()-0.5)*2);
                p.userData = { life: Math.random(), speed: 0.03 + Math.random()*0.05, scale: Math.random()*0.5 + 0.5 };
                group.add(p); fireParticles.push(p); 
            }

            // Cahaya Api Dramatis
            const fLight = new THREE.PointLight(0xff7675, 2, 15);
            fLight.position.set(-2.5, 1, 1.5);
            group.add(fLight);

            group.position.set(-1, 0, -100); 
            scene.add(group); worldObjects.push({mesh: group, isEvent: true});
        }

        function createTraffic() {
            const group = new THREE.Group();
            // Deretan 3 mobil macet rapat di lajur kanan
            const colors = [0xe84393, 0x00b894, 0xfdcb6e]; // Pink, Hijau, Kuning
            for(let i=0; i<3; i++) {
                const c = createRealisticCar(colors[i]);
                c.position.set(3, 0, i * -5.5); // Jarak antar mobil sangat dekat (5.5 unit)
                group.add(c);
            }
            group.position.set(0, 0, -100);
            scene.add(group); worldObjects.push({mesh: group, isEvent: true});
        }

        function createPitStopArea() {
            const group = new THREE.Group();
            const branch = new THREE.Mesh(new THREE.PlaneGeometry(8, 20), matRoad);
            branch.rotation.x = -Math.PI/2; branch.position.set(-8, 0.015, 0);
            const roof = new THREE.Mesh(new THREE.BoxGeometry(10, 0.5, 6), new THREE.MeshStandardMaterial({color:0xff7675}));
            roof.position.set(-8, 4, 0); roof.castShadow = true;
            const p1 = new THREE.Mesh(new THREE.CylinderGeometry(0.2,0.2,4), matDark); p1.position.set(-12, 2, -2);
            const p2 = new THREE.Mesh(new THREE.CylinderGeometry(0.2,0.2,4), matDark); p2.position.set(-4, 2, -2);
            group.add(branch); group.add(roof); group.add(p1); group.add(p2);
            group.position.set(0, 0, -100);
            scene.add(group); worldObjects.push({mesh: group, isEvent: true, isPitstop: true});
        }

        function createPotholes() {
            const group = new THREE.Group();
            const holeMat = new THREE.MeshBasicMaterial({color: 0x1a1a1a});
            const h1 = new THREE.Mesh(new THREE.CircleGeometry(1.2, 8), holeMat); h1.rotation.x = -Math.PI/2; h1.position.set(3, 0.02, 0);
            const h2 = new THREE.Mesh(new THREE.CircleGeometry(0.8, 6), holeMat); h2.rotation.x = -Math.PI/2; h2.position.set(2, 0.02, 3);
            const h3 = new THREE.Mesh(new THREE.CircleGeometry(1.5, 7), holeMat); h3.rotation.x = -Math.PI/2; h3.position.set(4, 0.02, -2);
            group.add(h1); group.add(h2); group.add(h3);
            group.position.set(0, 0, -100);
            scene.add(group); worldObjects.push({mesh: group, isEvent: true});
        }

        // ==========================================
        // 5. STATE & LOGIKA GAME
        // ==========================================
        let speed = 0.8; 
        let isPaused = true; 
        let distance = 0;
        let score = 0;
        let gas = 100;
        
        let isGameOver = false;
        let hasHitFinishLine = false;
        let hasDonePitStop = false; 
        let startTime = 0; let bestTimeStr = "";
        let envSpawnTimer = 0;

        // Controller Inputs
        const keys = { ArrowLeft: false, ArrowRight: false, ArrowDown: false, ArrowUp: false };
        const mapKey = (e, state) => {
            if(e.key === 'ArrowLeft' || e.code === 'ArrowLeft') keys.ArrowLeft = state;
            if(e.key === 'ArrowRight' || e.code === 'ArrowRight') keys.ArrowRight = state;
            if(e.key === 'ArrowDown' || e.code === 'ArrowDown') keys.ArrowDown = state;
            if(e.key === 'ArrowUp' || e.code === 'ArrowUp') keys.ArrowUp = state;
        };
        window.addEventListener('keydown', (e) => mapKey(e, true));
        window.addEventListener('keyup', (e) => mapKey(e, false));

        const setupDriveBtn = (id, keyName) => {
            const btn = document.getElementById(id);
            btn.addEventListener('touchstart', (e) => { e.preventDefault(); keys[keyName] = true; }, {passive: false});
            btn.addEventListener('touchend', (e) => { e.preventDefault(); keys[keyName] = false; }, {passive: false});
            btn.addEventListener('mousedown', () => { keys[keyName] = true; });
            btn.addEventListener('mouseup', () => { keys[keyName] = false; });
            btn.addEventListener('mouseleave', () => { keys[keyName] = false; });
        };
        setupDriveBtn('btn-left', 'ArrowLeft'); setupDriveBtn('btn-right', 'ArrowRight'); setupDriveBtn('btn-brake', 'ArrowDown'); setupDriveBtn('btn-up', 'ArrowUp');

        document.getElementById('btn-start-game').onclick = () => {
            document.getElementById('start-overlay').style.display = 'none';
            isPaused = false; startTime = Date.now();
        };
        
        document.getElementById('pause-btn').onclick = () => {
            const isAnyModalOpen = document.getElementById('quiz-overlay').style.display === 'flex' || 
                                   document.getElementById('finish-overlay').style.display === 'flex' ||
                                   document.getElementById('start-overlay').style.display === 'flex';
            if(!isGameOver && !hasHitFinishLine && !isAnyModalOpen) { 
                isPaused = !isPaused; 
            }
        };

        document.getElementById('close-finish-btn').onclick = () => { window.location.href = '/finish-line'; };

        // ==========================================
        // 6. LOGIKA KUIS & PIT STOP
        // ==========================================
        let currentQuizMode = ''; 
        const articleQuizzes = [
            { dist: 200, title: "YELLOW FLAG", q: "Ada kecelakaan di bagian kiri jalan. Tindakan antisipasi terbaik?", a: [{t: "Melaju maksimal", c: false}, {t: "Turunkan kecepatan & berhati-hati", c: true}, {t: "Pindah kanan & gaspol", c: false}], triggered: false },
            { dist: 500, title: "RACING LINE", q: "Kondisi lalu lintas padat di lajur kanan. Langkah aman?", a: [{t: "Pindah ke lajur kosong & sesuaikan kecepatan", c: true}, {t: "Paksa masuk ke kanan", c: false}, {t: "Rem mendadak", c: false}], triggered: false },
            { dist: 800, title: "BRAKE ZONE", q: "Jalanan rusak parah di kanan lintasan. Teknik pengereman yang tepat?", a: [{t: "Melaju berliku tanpa rem", c: false}, {t: "Tarik rem tangan mendadak", c: false}, {t: "Rem bertahap sebelum lubang & menghindar", c: true}], triggered: false }
        ];
        const pitStopQs = [
            { q: "(1/3) Fungsi utama oli mesin?", a: [{t: "Mendinginkan AC", c: false}, {t: "Melumasi komponen internal", c: true}, {t: "Menambah listrik", c: false}] },
            { q: "(2/3) Indikator temperatur merah artinya?", a: [{t: "Mesin Overheat", c: true}, {t: "Bensin bocor", c: false}, {t: "Ban kempis", c: false}] },
            { q: "(3/3) Cairan untuk wiper kaca depan?", a: [{t: "Air Aki", c: false}, {t: "Cairan khusus wiper", c: true}, {t: "Air sabun cuci", c: false}] }
        ];

        let pitIndex = 0; let pitTimer; let timeLeft = 100;
        const qOverlay = document.getElementById('quiz-overlay');
        const qBtns = document.querySelectorAll('.quiz-btn');

        function triggerQuiz(qData) {
            currentQuizMode = 'article'; isPaused = true; qData.triggered = true;
            document.getElementById('timer-bar-wrap').style.display = 'none';
            document.getElementById('quiz-title').innerText = qData.title;
            document.getElementById('quiz-question').innerText = qData.q;
            qBtns.forEach((btn, i) => { btn.innerText = qData.a[i].t; btn.setAttribute('data-correct', qData.a[i].c); });
            qOverlay.style.display = 'flex';
        }

        function triggerPitStop() {
            if (hasDonePitStop) return; 
            currentQuizMode = 'pitstop'; isPaused = true; hasDonePitStop = true; pitIndex = 0;
            playerCar.position.x = -8; 
            qOverlay.style.display = 'flex'; loadPitQ();
        }

        function loadPitQ() {
            clearInterval(pitTimer); timeLeft = 100; document.getElementById('timer-bar-fill').style.width = "100%";
            document.getElementById('timer-bar-wrap').style.display = 'block';
            document.getElementById('quiz-title').innerText = "PIT STOP";
            document.getElementById('quiz-title').innerText = "PIT STOP";
            document.getElementById('quiz-question').innerText = pitStopQs[pitIndex].q;
            qBtns.forEach((btn, i) => { btn.innerText = pitStopQs[pitIndex].a[i].t; btn.setAttribute('data-correct', pitStopQs[pitIndex].a[i].c); });
            
            pitTimer = setInterval(() => {
                timeLeft -= 1.5; document.getElementById('timer-bar-fill').style.width = timeLeft + "%";
                if(timeLeft <= 0) { clearInterval(pitTimer); handlePitAnswer(false); }
            }, 100);
        }

        function handlePitAnswer(isCorrect) {
            clearInterval(pitTimer);
            if(isCorrect) { 
                gas += 34; if(gas>100) gas=100; 
                showToast("Benar! +1 Bar Bensin.", "success"); 
            } else { 
                showToast("Salah / Waktu Habis!", "error"); 
            }
            
            pitIndex++;
            if(pitIndex < pitStopQs.length) {
                loadPitQ();
            } else {
                qOverlay.style.display = 'none'; currentQuizMode = '';
                if(gas <= 0) { 
                    isGameOver = true; showToast("GAME OVER! Bensin Habis.", "error"); 
                } else { 
                    showToast("Pit Stop Selesai! Melanjutkan perjalanan.", "success"); 
                    playerCar.position.x = 0; isPaused = false; 
                } 
            }
        }

        qBtns.forEach(btn => {
            btn.onclick = (e) => {
                const isCorrect = e.target.getAttribute('data-correct') === 'true';
                if (currentQuizMode === 'article') {
                    if(isCorrect) { 
                        score += 10; showToast("Jawaban Tepat! +10 Poin.", "success"); 
                    } else { 
                        score -= 10; showToast("Jawaban Salah! -10 Poin.", "error"); 
                    }
                    document.getElementById('score-ui').innerText = score;
                    qOverlay.style.display = 'none'; currentQuizMode = ''; isPaused = false;
                } else if (currentQuizMode === 'pitstop') {
                    handlePitAnswer(isCorrect);
                }
            };
        });

        // ==========================================
        // 7. RENDER LOOP UTAMA
        // ==========================================
        function animate() {
            requestAnimationFrame(animate);

            if (!isPaused && !isGameOver && !hasHitFinishLine) {
                let moveSpeed = keys.ArrowUp ? speed * 1.5 : (keys.ArrowDown ? speed * 0.4 : speed);
                distance += (moveSpeed * 0.2); 
                let currentDist = Math.floor(distance);
                document.getElementById('distance-ui').innerText = currentDist;

                envSpawnTimer++;
                if(envSpawnTimer > 30 / moveSpeed) { spawnEnvironment(); envSpawnTimer = 0; }

                for (let i = worldObjects.length - 1; i >= 0; i--) {
                    let obj = worldObjects[i];
                    let mesh = obj.mesh || obj; 
                    mesh.position.z += moveSpeed;
                    
                    if(obj.isEvent && Math.abs(mesh.position.z) < 1) {
                        if(obj.isPitstop) triggerPitStop();
                        obj.isEvent = false; 
                    }

                    if (mesh.position.z > 20) {
                        scene.remove(mesh); worldObjects.splice(i, 1);
                    }
                }

                // ANIMASI EFEK API KECELAKAAN (Bergerak & Berubah Warna)
                if (fireParticles.length > 0) {
                    fireParticles.forEach(p => {
                        // Cek kalau partikel masih berada di dalam scene (parent ada)
                        if (p.parent) {
                            p.position.y += p.userData.speed;
                            p.userData.life -= 0.02;
                            p.scale.setScalar(p.userData.life * p.userData.scale);
                            
                            // Reset particle
                            if(p.userData.life <= 0) {
                                p.position.y = 0; 
                                p.userData.life = 1;
                            }
                            
                            // Gradasi Warna: Kuning -> Merah -> Abu-abu asap
                            if(p.userData.life > 0.6) p.material.color.setHex(0xfdcb6e); 
                            else if(p.userData.life > 0.3) p.material.color.setHex(0xff7675); 
                            else p.material.color.setHex(0x636e72); 
                        }
                    });
                }

                if(currentDist === 190) createAccident(); 
                if(currentDist === 490) createTraffic();
                if(currentDist === 640) createPitStopArea();
                if(currentDist === 790) createPotholes();

                articleQuizzes.forEach(q => { if(currentDist === q.dist && !q.triggered) triggerQuiz(q); });

                if (!hasDonePitStop) {
                    gas = 100 - (distance / 660) * 100;
                    if(gas <= 0) gas = 0; 
                } else { gas -= 0.01; }
                
                const gasFill = document.getElementById('gas-fill');
                gasFill.style.width = gas + "%";
                gasFill.style.background = gas < 30 ? "linear-gradient(90deg, #ff7675, #d63031)" : "linear-gradient(90deg, #55efc4, #00b894)";

                const turnSpeed = 0.15;
                if (keys.ArrowLeft && playerCar.position.x > -4) playerCar.position.x -= turnSpeed;
                if (keys.ArrowRight && playerCar.position.x < 4) playerCar.position.x += turnSpeed;
                
                playerCar.children.forEach(child => {
                    if(child.geometry.type === 'CylinderGeometry') {
                        child.rotation.x -= moveSpeed * 0.1; 
                    }
                });

                // ==========================================
                // FINISH LINE LOGIC
                // ==========================================
                if (currentDist >= 1000 && !hasHitFinishLine) {
                    hasHitFinishLine = true; isPaused = true;
                    let timeDiff = Date.now() - startTime;
                    let m = Math.floor(timeDiff / 60000), s = Math.floor((timeDiff % 60000) / 1000), ms = Math.floor((timeDiff % 1000) / 10);
                    bestTimeStr = `${m<10?'0':''}${m}:${s<10?'0':''}${s}.${ms<10?'0':''}${ms}`;

                    document.getElementById('final-score').innerText = score;
                    document.getElementById('finish-overlay').style.display = 'flex';

                    fetch('/save-score', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                        body: JSON.stringify({ score: score, best_time: bestTimeStr })
                    }).then(res => res.json()).then(data => {
                        document.getElementById('saving-status').innerHTML = `Data tersimpan!<br>Waktu kamu: <b>${bestTimeStr}</b>`;
                        document.getElementById('saving-status').style.color = "#00b894";
                        document.getElementById('close-finish-btn').style.display = "block";
                    }).catch(err => {
                        document.getElementById('saving-status').innerText = "Gagal menyimpan skor ke server.";
                        document.getElementById('saving-status').style.color = "#ff7675";
                        document.getElementById('close-finish-btn').style.display = "block";
                    });
                }
            }
            renderer.render(scene, camera);
        }

        animate();

        window.addEventListener('resize', () => { 
            renderer.setSize(window.innerWidth, window.innerHeight); 
            camera.aspect = window.innerWidth / window.innerHeight; 
            camera.updateProjectionMatrix(); 
        });
        
    </script>
</body>
</html>