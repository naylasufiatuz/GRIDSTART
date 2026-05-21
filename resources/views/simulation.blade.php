<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Grid Start - Pro Simulation</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.4);
            --glass-border: rgba(255, 255, 255, 0.6);
            --text-dark: #2d3436;
            --accent-green: #00b894;
            --accent-red: #ff7675;
            --accent-yellow: #fdcb6e;
        }

        body { 
            margin: 0; overflow: hidden; 
            background-color: #b5eaea; /* Pastel Sky Fallback */
            font-family: 'Poppins', sans-serif; 
            touch-action: none; 
        }
        canvas { display: block; position: absolute; top: 0; left: 0; z-index: 1; }
        
        /* =========================================
           UI HUD (Kiri Atas ala Referensi) 
           ========================================= */
        #hud-panel {
            position: absolute; top: 30px; left: 30px; z-index: 100;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 20px 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            color: var(--text-dark);
            min-width: 150px;
        }
        .hud-item {
            font-size: 16px; font-weight: 600; margin-bottom: 8px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .hud-item:last-child { margin-bottom: 0; }
        .hud-value { font-weight: 800; color: #fff; text-shadow: 1px 1px 2px rgba(0,0,0,0.2); }
        
        /* Bar Bensin Modern */
        .gas-bar-container { width: 100%; height: 12px; background: rgba(0,0,0,0.1); border-radius: 10px; overflow: hidden; margin-top: 5px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1); }
        .gas-bar-fill { height: 100%; width: 100%; background: linear-gradient(90deg, #55efc4, #00b894); transition: width 0.3s, background 0.3s; }

        /* Tombol Pause & Sound (Kanan Bawah ala Referensi) */
        #action-panel { position: absolute; bottom: 30px; right: 30px; z-index: 100; display: flex; flex-direction: column; gap: 15px; }
        .circle-btn {
            width: 60px; height: 60px; border-radius: 50%;
            background: var(--glass-bg); backdrop-filter: blur(12px); border: 1px solid var(--glass-border);
            display: flex; justify-content: center; align-items: center;
            font-size: 24px; color: var(--text-dark); cursor: pointer;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1); transition: 0.2s;
        }
        .circle-btn:active { transform: scale(0.9); }

        /* =========================================
           D-PAD KONTROL (Tengah Bawah) 
           ========================================= */
        #d-pad {
            position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%);
            z-index: 100; display: grid; grid-template-columns: repeat(3, 70px); grid-template-rows: repeat(2, 70px);
            gap: 10px; user-select: none;
        }
        .d-btn {
            background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.8); border-radius: 18px;
            display: flex; justify-content: center; align-items: center;
            font-size: 28px; color: #333; cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.1s;
        }
        .d-btn:active { background: rgba(255, 255, 255, 0.8); transform: scale(0.92); }
        /* Posisi Grid */
        #btn-up { grid-column: 2; grid-row: 1; background: rgba(120, 224, 143, 0.6); color: white; } 
        #btn-left { grid-column: 1; grid-row: 2; }
        #btn-brake { grid-column: 2; grid-row: 2; background: rgba(255, 118, 117, 0.6); color: white; font-size: 16px; font-weight: bold; }
        #btn-right { grid-column: 3; grid-row: 2; }

        /* =========================================
           MODAL & OVERLAYS (Sleek & Clean)
           ========================================= */
        .overlay-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(45, 52, 54, 0.6); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
            display: none; justify-content: center; align-items: center; z-index: 1000;
        }
        .modal-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(255,255,255,0.85));
            border: 1px solid white; border-radius: 30px; padding: 40px;
            width: 85%; max-width: 550px; box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            text-align: center;
        }
        .modal-card h2 { margin: 0 0 15px 0; font-size: 28px; color: var(--text-dark); letter-spacing: -0.5px; }
        .modal-card p { font-size: 16px; color: #636e72; line-height: 1.6; margin-bottom: 25px; }
        
        .btn-primary {
            background: var(--accent-green); color: white; border: none; border-radius: 14px;
            padding: 15px 35px; font-size: 18px; font-weight: 600; cursor: pointer;
            box-shadow: 0 10px 20px rgba(0, 184, 148, 0.3); transition: 0.2s; font-family: 'Poppins', sans-serif;
        }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(0, 184, 148, 0.4); }

        /* Kuis Options */
        .quiz-opts { display: flex; flex-direction: column; gap: 12px; }
        .quiz-btn {
            background: white; border: 2px solid #dfe6e9; border-radius: 16px;
            padding: 16px; font-size: 15px; font-weight: 600; color: var(--text-dark);
            cursor: pointer; transition: 0.2s; text-align: left; font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .quiz-btn:hover { border-color: var(--accent-yellow); background: #fffcf3; transform: translateX(5px); }
        
        #timer-bar-wrap { width: 100%; height: 8px; background: #eee; border-radius: 4px; margin-bottom: 20px; overflow: hidden; display: none; }
        #timer-bar-fill { width: 100%; height: 100%; background: var(--accent-red); transition: width 0.1s linear; }

        #start-overlay { display: flex; z-index: 1100; } 
    </style>
</head>
<body>

    <div id="hud-panel">
        <div class="hud-item">Jarak <span class="hud-value"><span id="distance-ui">0</span>m</span></div>
        <div class="hud-item">Poin <span class="hud-value" id="score-ui">0</span></div>
        <div style="margin-top: 15px; font-size: 14px; font-weight: 600;">Bensin</div>
        <div class="gas-bar-container"><div class="gas-bar-fill" id="gas-fill"></div></div>
    </div>

    <div id="action-panel">
        <div class="circle-btn" id="pause-btn">⏸</div>
        <div class="circle-btn">🔊</div> 
    </div>

    <div id="d-pad">
        <div class="d-btn" id="btn-up">↑</div>
        <div class="d-btn" id="btn-left">←</div>
        <div class="d-btn" id="btn-brake">REM</div>
        <div class="d-btn" id="btn-right">→</div>
    </div>

    <div id="start-overlay" class="overlay-bg">
        <div class="modal-card">
            <h2>🏁 START GRID</h2>
            <p><strong>Pengenalan Keselamatan Berkendara</strong><br><br>Persiapkan mental dan pahami prinsip <em>Safety First</em>. Hindari kelalaian, dan selalu utamakan keselamatan di atas kecepatan!</p>
            <button id="btn-start-game" class="btn-primary">TANCAP GAS!</button>
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
            <h2 style="color: var(--accent-green);">🏁 FINISH LINE!</h2>
            <p>Simulasi berkendara telah selesai dengan sukses.</p>
            <div style="font-size: 18px; color: #636e72; margin: 20px 0;">Total Poin</div>
            <div style="font-size: 48px; font-weight: 800; color: var(--accent-yellow); margin-bottom: 20px;" id="final-score">0</div>
            <p id="saving-status" style="font-style: italic; font-size: 14px;">Menyimpan skor ke server...</p>
            <button id="close-finish-btn" class="btn-primary" style="display: none; width: 100%;">Lihat Papan Peringkat</button>
        </div>
    </div>

    <script type="importmap">
        { "imports": { "three": "https://unpkg.com/three@0.160.0/build/three.module.js" } }
    </script>

    <script type="module">
        import * as THREE from 'three';

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
        // 2. LIGHTING (WARM PASTEL)
        // ==========================================
        const hemiLight = new THREE.HemisphereLight(0xffffff, 0xc8e6c9, 0.6);
        scene.add(hemiLight);

        const dirLight = new THREE.DirectionalLight(0xffeaa7, 0.8);
        dirLight.position.set(50, 100, 50);
        dirLight.castShadow = true;
        dirLight.shadow.camera.top = 100;
        dirLight.shadow.camera.bottom = -100;
        dirLight.shadow.camera.left = -100;
        dirLight.shadow.camera.right = 100;
        dirLight.shadow.mapSize.width = 2048;
        dirLight.shadow.mapSize.height = 2048;
        scene.add(dirLight);

        // ==========================================
        // 3. LOW-POLY PROCEDURAL GENERATOR
        // ==========================================
        const matGround = new THREE.MeshStandardMaterial({ color: 0xe1f2e3, flatShading: true }); 
        const matRoad = new THREE.MeshStandardMaterial({ color: 0x95a5a6, roughness: 0.9 });
        const matLine = new THREE.MeshBasicMaterial({ color: 0xffffff });
        const matWood = new THREE.MeshStandardMaterial({ color: 0x8b5a2b, flatShading: true });
        const matLeaves = new THREE.MeshStandardMaterial({ color: 0x55efc4, flatShading: true });
        const matCarBody = new THREE.MeshStandardMaterial({ color: 0xff7675, flatShading: true }); 
        const matDark = new THREE.MeshStandardMaterial({ color: 0x2d3436, flatShading: true });
        const matGlass = new THREE.MeshStandardMaterial({ color: 0x74b9ff, roughness: 0.1 });

        const ground = new THREE.Mesh(new THREE.PlaneGeometry(500, 500), matGround);
        ground.rotation.x = -Math.PI / 2;
        ground.receiveShadow = true;
        scene.add(ground);

        const road = new THREE.Mesh(new THREE.PlaneGeometry(12, 500), matRoad);
        road.rotation.x = -Math.PI / 2;
        road.position.y = 0.01;
        road.receiveShadow = true;
        scene.add(road);

        function createLowPolyCar(colorMaterial) {
            const carGroup = new THREE.Group();
            const bottom = new THREE.Mesh(new THREE.BoxGeometry(2, 0.6, 4), colorMaterial);
            bottom.position.y = 0.5; bottom.castShadow = true;
            carGroup.add(bottom);
            const top = new THREE.Mesh(new THREE.BoxGeometry(1.5, 0.5, 2), matGlass);
            top.position.set(0, 1.05, -0.2); top.castShadow = true;
            carGroup.add(top);
            const wheelGeo = new THREE.CylinderGeometry(0.35, 0.35, 0.3, 12); wheelGeo.rotateZ(Math.PI / 2);
            [[-1.1, 0.35, 1.2], [1.1, 0.35, 1.2], [-1.1, 0.35, -1.2], [1.1, 0.35, -1.2]].forEach(pos => {
                const wheel = new THREE.Mesh(wheelGeo, matDark);
                wheel.position.set(...pos); wheel.castShadow = true; carGroup.add(wheel);
            });
            return carGroup;
        }

        const playerCar = createLowPolyCar(matCarBody);
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

        function spawnEnvironment() {
            const line = new THREE.Mesh(new THREE.PlaneGeometry(0.2, 2), matLine);
            line.rotation.x = -Math.PI / 2; line.position.set(0, 0.02, -150);
            scene.add(line); worldObjects.push(line);

            if(Math.random() > 0.3) { const treeL = createLowPolyTree(); treeL.position.set(-8 - Math.random()*10, 0, -150); scene.add(treeL); worldObjects.push(treeL); }
            if(Math.random() > 0.3) { const treeR = createLowPolyTree(); treeR.position.set(8 + Math.random()*10, 0, -150); scene.add(treeR); worldObjects.push(treeR); }
            if(Math.random() > 0.8) { const lamp = createLampPost(); lamp.position.set(-6.5, 0, -150); scene.add(lamp); worldObjects.push(lamp); }
        }

        // ==========================================
        // 4. SKENARIO OBJEK KHUSUS (ACCIDENT, TRAFFIC, DLL)
        // ==========================================
        function createAccident() {
            const group = new THREE.Group();
            const car1 = createLowPolyCar(new THREE.MeshStandardMaterial({color:0x74b9ff, flatShading:true}));
            car1.rotation.y = Math.PI/4; car1.position.set(-2, 0, 0);
            const car2 = createLowPolyCar(new THREE.MeshStandardMaterial({color:0x2d3436, flatShading:true}));
            car2.rotation.y = -Math.PI/3; car2.position.set(-3, 0, 2);
            group.add(car1); group.add(car2);
            group.position.set(-2, 0, -100); 
            scene.add(group); worldObjects.push({mesh: group, isEvent: true});
        }

        function createTraffic() {
            const group = new THREE.Group();
            const c1 = createLowPolyCar(new THREE.MeshStandardMaterial({color:0xfdcb6e, flatShading:true}));
            c1.position.set(3, 0, 0);
            const c2 = createLowPolyCar(new THREE.MeshStandardMaterial({color:0x00cec9, flatShading:true}));
            c2.position.set(3, 0, -6);
            group.add(c1); group.add(c2);
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
            const holeMat = new THREE.MeshBasicMaterial({color: 0x2d3436});
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

        // Setup D-Pad Buttons (Tetap menggunakan touchstart khusus untuk kontrol mobil agar responsif)
        const setupDriveBtn = (id, keyName) => {
            const btn = document.getElementById(id);
            btn.addEventListener('touchstart', (e) => { e.preventDefault(); keys[keyName] = true; }, {passive: false});
            btn.addEventListener('touchend', (e) => { e.preventDefault(); keys[keyName] = false; }, {passive: false});
            btn.addEventListener('mousedown', () => { keys[keyName] = true; });
            btn.addEventListener('mouseup', () => { keys[keyName] = false; });
            btn.addEventListener('mouseleave', () => { keys[keyName] = false; });
        };
        setupDriveBtn('btn-left', 'ArrowLeft'); setupDriveBtn('btn-right', 'ArrowRight'); setupDriveBtn('btn-brake', 'ArrowDown'); setupDriveBtn('btn-up', 'ArrowUp');

        // UI Buttons FIX: Menggunakan onclick untuk mencegah Double Firing Bug di HP
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

        document.getElementById('close-finish-btn').onclick = () => { window.location.href = '/leaderboard'; };

        // ==========================================
        // 6. LOGIKA KUIS & PIT STOP
        // ==========================================
        let currentQuizMode = ''; 
        const articleQuizzes = [
            { dist: 200, title: "⚠️ YELLOW FLAG", q: "Ada kecelakaan di bagian kiri jalan. Tindakan antisipasi terbaik?", a: [{t: "Melaju maksimal", c: false}, {t: "Turunkan kecepatan & berhati-hati", c: true}, {t: "Pindah kanan & gaspol", c: false}], triggered: false },
            { dist: 500, title: "🛣️ RACING LINE", q: "Kondisi lalu lintas padat di lajur kanan. Langkah aman?", a: [{t: "Pindah ke lajur kosong & sesuaikan kecepatan", c: true}, {t: "Paksa masuk ke kanan", c: false}, {t: "Rem mendadak", c: false}], triggered: false },
            { dist: 800, title: "🛑 BRAKE ZONE", q: "Jalanan rusak parah di kanan lintasan. Teknik pengereman yang tepat?", a: [{t: "Melaju berliku tanpa rem", c: false}, {t: "Tarik rem tangan mendadak", c: false}, {t: "Rem bertahap sebelum lubang & menghindar", c: true}], triggered: false }
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
            if (hasDonePitStop) return; // Mencegah kepanggil dua kali
            currentQuizMode = 'pitstop'; isPaused = true; hasDonePitStop = true; pitIndex = 0;
            playerCar.position.x = -8; // Mobil pindah ke atap Pit Stop
            qOverlay.style.display = 'flex'; loadPitQ();
        }

        function loadPitQ() {
            clearInterval(pitTimer); timeLeft = 100; document.getElementById('timer-bar-fill').style.width = "100%";
            document.getElementById('timer-bar-wrap').style.display = 'block';
            document.getElementById('quiz-title').innerText = "⛽ PIT STOP";
            document.getElementById('quiz-question').innerText = pitStopQs[pitIndex].q;
            qBtns.forEach((btn, i) => { btn.innerText = pitStopQs[pitIndex].a[i].t; btn.setAttribute('data-correct', pitStopQs[pitIndex].a[i].c); });
            
            pitTimer = setInterval(() => {
                timeLeft -= 1.5; document.getElementById('timer-bar-fill').style.width = timeLeft + "%";
                if(timeLeft <= 0) { clearInterval(pitTimer); handlePitAnswer(false); }
            }, 100);
        }

        function handlePitAnswer(isCorrect) {
            clearInterval(pitTimer);
            if(isCorrect) { gas += 34; if(gas>100) gas=100; alert("Benar! +Bensin."); } else { alert("Salah / Waktu Habis!"); }
            
            pitIndex++;
            if(pitIndex < pitStopQs.length) {
                loadPitQ();
            } else {
                qOverlay.style.display = 'none'; currentQuizMode = '';
                if(gas <= 0) { 
                    isGameOver = true; alert("GAME OVER! Bensin Habis."); 
                } else { 
                    alert("Pit Stop Selesai! Melanjutkan perjalanan."); 
                    playerCar.position.x = 0; // Kembalikan mobil ke jalan utama
                    isPaused = false; 
                } 
            }
        }

        // UI BUTTON FIX: Menggunakan onclick langsung untuk mematikan double-firing event
        qBtns.forEach(btn => {
            btn.onclick = (e) => {
                const isCorrect = e.target.getAttribute('data-correct') === 'true';
                if (currentQuizMode === 'article') {
                    if(isCorrect) { score += 10; alert("Benar! +10 Poin."); } else { score -= 10; alert("Salah! -10 Poin."); }
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
                // Update Jarak
                let moveSpeed = keys.ArrowUp ? speed * 1.5 : (keys.ArrowDown ? speed * 0.4 : speed);
                distance += (moveSpeed * 0.2); 
                let currentDist = Math.floor(distance);
                document.getElementById('distance-ui').innerText = currentDist;

                // Spawner Lingkungan
                envSpawnTimer++;
                if(envSpawnTimer > 30 / moveSpeed) { spawnEnvironment(); envSpawnTimer = 0; }

                // Move World Objects
                for (let i = worldObjects.length - 1; i >= 0; i--) {
                    let obj = worldObjects[i];
                    let mesh = obj.mesh || obj; 
                    mesh.position.z += moveSpeed;
                    
                    // TRIGGER EVENT SAAT BANGUNAN MENCAPAI KAMERA
                    if(obj.isEvent && Math.abs(mesh.position.z) < 1) {
                        if(obj.isPitstop) triggerPitStop();
                        obj.isEvent = false; // Matikan trigger agar tidak loop
                    }

                    if (mesh.position.z > 20) {
                        scene.remove(mesh); worldObjects.splice(i, 1);
                    }
                }

                if(currentDist === 190) createAccident(); 
                if(currentDist === 490) createTraffic();
                if(currentDist === 640) createPitStopArea();
                if(currentDist === 790) createPotholes();

                articleQuizzes.forEach(q => { if(currentDist === q.dist && !q.triggered) triggerQuiz(q); });

                // SINKRONISASI BENSIN FIX: Akan tepat 0 saat jarak 660m (saat bangunan Pit Stop sampai)
                if (!hasDonePitStop) {
                    gas = 100 - (distance / 660) * 100;
                    if(gas <= 0) { gas = 0; } 
                } else { 
                    gas -= 0.01; 
                }
                
                const gasFill = document.getElementById('gas-fill');
                gasFill.style.width = gas + "%";
                gasFill.style.background = gas < 30 ? "linear-gradient(90deg, #ff7675, #d63031)" : "linear-gradient(90deg, #55efc4, #00b894)";

                // Kontrol Setir Mobil
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