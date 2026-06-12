   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Grid Start - Pro Simulation</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/simulation.css') }}">
</head>
<body>

    <div id="toast-container"></div>

    {{-- ======================== HUD PANEL ======================== --}}
    <div id="hud-panel">
        <div class="hud-console-header">
          <span class="hud-console-title">GRID SYSTEM</span>
        </div>
        <div class="hud-metrics">
            <div class="hud-metric">
                <span class="hud-label">DISTANCE</span>
                <span class="hud-val"><span id="distance-ui">0</span> <span class="hud-unit">M</span></span>
            </div>
            <div class="hud-metric">
                <span class="hud-label">SPEED</span>
                <span class="hud-val"><span id="speed-ui">0</span> <span class="hud-unit">KM/H</span></span>
            </div>
            <div class="hud-metric">
                <span class="hud-label">PTS EARNED</span>
                <span class="hud-val" id="score-ui">0</span>
            </div>
        </div>
        <div class="hud-fuel-panel">
            <div class="hud-fuel-label-row">
                <span class="hud-label">FUEL CAPACITY</span>
                <span class="hud-fuel-pct" id="fuel-percentage-ui">100%</span>
            </div>
            <div class="gas-bar-container"><div class="gas-bar-fill" id="gas-fill"></div></div>
        </div>
    </div>

    {{-- ======================== ACTION DRAWER (NO EMOJIS) ======================== --}}
    <div id="action-panel">
        <div class="circle-btn" id="pause-btn" aria-label="Pause system">
            <svg viewBox="0 0 24 24" width="18" height="18"><rect x="5" y="4" width="4" height="16" fill="currentColor"></rect><rect x="15" y="4" width="4" height="16" fill="currentColor"></rect></svg>
        </div>
    </div>

    {{-- ======================== D-PAD (CROSS LAYOUT) ======================== --}}
    <div id="d-pad">
        <div class="d-btn" id="btn-gas" aria-label="Accelerate">
            <svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"></polyline></svg>
        </div>
        <div class="d-btn" id="btn-left" aria-label="Steer left">
            <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </div>
        <div class="d-btn" id="btn-brake">REM</div>
        <div class="d-btn" id="btn-right" aria-label="Steer right">
            <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </div>

    {{-- ======================== INTERACTIVE MODALS ======================== --}}
    <div id="start-overlay" class="overlay-bg">
        <div class="modal-card start-card">
            <div class="hud-badge cyan">STAGE 01 • INITIAL DEPARTURE</div>
            <h2 class="tech-title">START GRID</h2>
            
            <div class="f1-lights-container">
                <div class="f1-light-row">
                    <span class="f1-bulb red"></span>
                    <span class="f1-bulb red"></span>
                    <span class="f1-bulb red"></span>
                    <span class="f1-bulb red"></span>
                    <span class="f1-bulb red"></span>
                </div>
                <div class="lights-reflection">READY TO ACCELERATE</div>
            </div>

            <p class="tech-desc"><strong>Pengenalan Keselamatan Berkendara</strong><br><br>Persiapkan mental dan pahami prinsip <em>Safety First</em>. Hindari kelalaian, dan selalu utamakan keselamatan di atas kecepatan!</p>
            
            <button id="btn-start-game" class="btn-primary" style="width: 100%;">
                <span class="btn-shine"></span>
                TANCAP GAS!
            </button>
        </div>
    </div>

    {{-- ======================== QUIZ BOTTOM PANEL (NO POPUP) ======================== --}}
    <div id="quiz-panel" style="display: none;">
        <div class="quiz-panel-inner">
            <div class="quiz-panel-header">
                <span class="hud-badge yellow" id="quiz-badge-label">SYSTEM CHECK</span>
                <div id="timer-bar-wrap" class="hud-timer-wrap" style="display:none;">
                    <div id="timer-bar-fill" class="hud-timer-fill"></div>
                </div>
            </div>
            <h2 id="quiz-title" class="tech-title">Peringatan!</h2>
            <p id="quiz-question" class="tech-desc">Pertanyaan akan muncul di sini.</p>
            <div class="quiz-opts">
                <button class="quiz-btn" id="btn-opt-a">A</button>
                <button class="quiz-btn" id="btn-opt-b">B</button>
                <button class="quiz-btn" id="btn-opt-c">C</button>
                <button class="quiz-btn" id="btn-opt-d">D</button>
            </div>
        </div>
    </div>

    <div id="finish-overlay" class="overlay-bg">
        <div class="modal-card finish-card">
            <div class="hud-badge green">STAGE COMPLETE</div>
            
            <div class="finish-title-wrap">
                <div class="checkered-accent"></div>
                <h2 class="tech-title text-green">FINISH LINE!</h2>
                <div class="checkered-accent"></div>
            </div>

            <p class="tech-desc">Simulasi berkendara telah selesai dengan sukses. Analisis data performa Anda telah tersimpan.</p>
            
            <div class="telemetry-dashboard">
                <div class="telemetry-tile main-score">
                    <span class="tile-label">TOTAL RACING POINTS</span>
                    <span class="tile-value text-gold" id="final-score">0</span>
                    <span class="tile-unit">PTS</span>
                </div>
                <div class="telemetry-grid">
                    <div class="telemetry-tile mini">
                        <span class="tile-label">STATUS</span>
                        <span class="tile-value text-green">PASSED</span>
                    </div>
                    <div class="telemetry-tile mini">
                        <span class="tile-label">SAFETY RATIO</span>
                        <span class="tile-value text-cyan">98.4%</span>
                    </div>
                </div>
            </div>
            
            <div class="saving-status-box">
                <div class="saving-loader" id="saving-loader">
                    <span></span><span></span><span></span>
                </div>
                <p id="saving-status">Mencatat lap time ke leaderboard...</p>
            </div>
            
            <button id="close-finish-btn" class="btn-primary" style="display: none; width: 100%;">
                <span class="btn-shine"></span>
                Lanjutkan
            </button>
        </div>
    </div>

    <div id="gameover-overlay" class="overlay-bg">
        <div class="modal-card gameover-card">
            <div class="hud-badge red">GAME OVER</div>
            
            <div class="finish-title-wrap">
                <div class="checkered-accent"></div>
                <h2 class="tech-title text-brick">BENSIN HABIS!</h2>
                <div class="checkered-accent"></div>
            </div>

            <p class="tech-desc">Anda gagal mengelola bahan bakar dengan baik di pit stop. Pastikan untuk menjawab pertanyaan dengan tepat demi menjaga efisiensi berkendara Anda.</p>
            
            <div class="telemetry-dashboard" style="margin-bottom: 25px;">
                <div class="telemetry-tile main-score" style="border-color: var(--brand-brick-red); background: #fffaf9;">
                    <span class="tile-label" style="color: var(--brand-brick-red);">FUEL LEVEL</span>
                    <span class="tile-value text-brick" style="color: var(--brand-brick-red);">0%</span>
                    <span class="tile-unit" style="color: var(--brand-brick-red);">EMPTY</span>
                </div>
            </div>
            
            <div style="display: flex; gap: 12px; width: 100%;">
                <button id="btn-restart-game" class="btn-primary" style="flex: 1;">
                    <span class="btn-shine"></span>
                    Coba Lagi
                </button>
                <button id="btn-exit-game" class="btn-primary" style="flex: 1;">
                    <span class="btn-shine"></span>
                    Keluar
                </button>
            </div>
        </div>
    </div>

    <div id="pause-overlay" class="overlay-bg" style="display: none;">
        <div class="modal-card" style="text-align: center;">
            <div class="hud-badge yellow">PAUSED</div>
            <h2 class="tech-title" style="margin-top: 20px;">SIMULATION PAUSED</h2>
            <p class="tech-desc">Kendali telah ditangguhkan untuk sementara.</p>
            <button id="btn-resume-game" class="btn-primary" style="width: 100%; margin-top: 20px;">
                <span class="btn-shine"></span>
                Lanjutkan
            </button>
        </div>
    </div>

    {{-- ======================== IMPORT MAP & MODULE ======================== --}}
    <script type="importmap">
        { "imports": { "three": "https://unpkg.com/three@0.160.0/build/three.module.js" } }
    </script>

    <script type="module">
        import * as THREE from 'three';

        // ==========================================
        // 0. TOAST TELEMETRY FEEDBACK
        // ==========================================
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = message;
            container.appendChild(toast);
            
            setTimeout(() => { toast.classList.add('show'); }, 10);
            
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ==========================================
        // 1. SCENE SETUP - CLASSIC WARM MOTORSPORT DAYLIGHT
        // ==========================================
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0xd7f0f5); // Soft blue sky
        scene.fog = new THREE.Fog(0xd7f0f5, 20, 150); // Soft, natural fog depth

        const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 300);
        camera.position.set(0, 4, 10); 
        camera.lookAt(0, 0, -10);

        const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.shadowMap.enabled = true; 
        renderer.shadowMap.type = THREE.PCFSoftShadowMap; // Beautiful organic shadows
        document.body.appendChild(renderer.domElement);

        // ==========================================
        // 2. SUNSET YELLOW DAYLIGHT LIGHTING
        // ==========================================
        const hemiLight = new THREE.HemisphereLight(0xffffff, 0xc8e6c9, 0.65); // Natural sky to grass ambient
        scene.add(hemiLight);

        const dirLight = new THREE.DirectionalLight(0xffeaa7, 0.95); // Warm yellow directional sun
        dirLight.position.set(50, 100, 50);
        dirLight.castShadow = true;
        dirLight.shadow.camera.top = 80; dirLight.shadow.camera.bottom = -80;
        dirLight.shadow.camera.left = -80; dirLight.shadow.camera.right = 80;
        dirLight.shadow.camera.near = 0.5; dirLight.shadow.camera.far = 250;
        dirLight.shadow.mapSize.width = 2048; dirLight.shadow.mapSize.height = 2048;
        dirLight.shadow.bias = -0.0005;
        scene.add(dirLight);

        // ==========================================
        // 3. CLASSIC MOTORSPORT MATERIALS
        // ==========================================
        const matGround = new THREE.MeshStandardMaterial({ color: 0xe1f2e3, flatShading: true }); // Sage green grass
        const matRoad = new THREE.MeshStandardMaterial({ color: 0x95a5a6, roughness: 0.92 }); // Warm grey asphalt
        const matLine = new THREE.MeshBasicMaterial({ color: 0xffffff }); // Classic white lanes
        const matWood = new THREE.MeshStandardMaterial({ color: 0x8b5a2b, flatShading: true }); // Wooden trunk
        const matLeaves = new THREE.MeshStandardMaterial({ color: 0x55efc4, flatShading: true }); // Low poly organic leaves
        const matPole = new THREE.MeshStandardMaterial({ color: 0x2c3e50, roughness: 0.6, metalness: 0.4 });
        
        // Classic Vehicle Materials
        const matGlass = new THREE.MeshStandardMaterial({ color: 0x222222, roughness: 0.1, metalness: 0.8 });
        const matDark = new THREE.MeshStandardMaterial({ color: 0x111111, roughness: 0.9 });
        const matHeadlight = new THREE.MeshBasicMaterial({ color: 0xffffff });
        const matTaillight = new THREE.MeshBasicMaterial({ color: 0xff4757 }); // LED Taillight red
        const matTaillightBrake = new THREE.MeshBasicMaterial({ color: 0xff0000 }); // Brake flare red

        // ==========================================
        // 4. NATURAL LANDSCAPING AND ROAD BOUNDS
        // ==========================================
        
        const ground = new THREE.Mesh(new THREE.PlaneGeometry(500, 500), matGround);
        ground.rotation.x = -Math.PI / 2; ground.receiveShadow = true; scene.add(ground);

        const road = new THREE.Mesh(new THREE.PlaneGeometry(12, 500), matRoad);
        road.rotation.x = -Math.PI / 2; road.position.y = 0.01; road.receiveShadow = true; scene.add(road);

        // ==========================================
        // 5. MINIMALIST SPORTS RACER - BLUE/WHITE
        // ==========================================
        const matWhiteAccent = new THREE.MeshStandardMaterial({ color: 0xecf0f1, roughness: 0.3, metalness: 0.4 });
        const matWheelSilver = new THREE.MeshStandardMaterial({ color: 0xbdc3c7, roughness: 0.4, metalness: 0.6 });

        function createSleekSportsCar(primaryColorHex, isPlayer = false) {
            const car = new THREE.Group();
            const matBody = new THREE.MeshStandardMaterial({ color: primaryColorHex, roughness: 0.35, metalness: 0.55, flatShading: true });

            // 1. Low-profile aerodynamic chassis
            const chassis = new THREE.Mesh(new THREE.BoxGeometry(2.1, 0.35, 5.0), matBody);
            chassis.position.y = 0.38; chassis.castShadow = true; chassis.receiveShadow = true;
            car.add(chassis);

            // 2. Front nose taper (aerodynamic wedge)
            const nose = new THREE.Mesh(new THREE.BoxGeometry(1.8, 0.2, 0.8), matBody);
            nose.position.set(0, 0.32, -2.6); nose.castShadow = true;
            car.add(nose);

            // 3. Sleek low cockpit canopy
            const cabin = new THREE.Mesh(new THREE.BoxGeometry(1.5, 0.4, 1.8), matGlass);
            cabin.position.set(0, 0.75, -0.3); cabin.castShadow = true;
            car.add(cabin);

            // 4. White racing stripe down the center (minimalist accent)
            const stripe = new THREE.Mesh(new THREE.BoxGeometry(0.3, 0.02, 4.6), matWhiteAccent);
            stripe.position.set(0, 0.57, -0.1);
            car.add(stripe);

            // 5. Subtle rear diffuser lip (no big wing - minimalist)
            const diffuser = new THREE.Mesh(new THREE.BoxGeometry(2.0, 0.08, 0.3), matDark);
            diffuser.position.set(0, 0.25, 2.55);
            car.add(diffuser);

            // 6. Slim LED headlamps
            const hlL = new THREE.Mesh(new THREE.BoxGeometry(0.5, 0.06, 0.08), matHeadlight); hlL.position.set(-0.65, 0.45, -2.5);
            const hlR = new THREE.Mesh(new THREE.BoxGeometry(0.5, 0.06, 0.08), matHeadlight); hlR.position.set(0.65, 0.45, -2.5);
            car.add(hlL, hlR);

            // 7. Full-width LED taillight bar
            const tlBar = new THREE.Mesh(new THREE.BoxGeometry(1.8, 0.06, 0.08), matTaillight); tlBar.position.set(0, 0.45, 2.52);
            car.add(tlBar);

            // 8. Side air intakes (white accent)
            const intakeL = new THREE.Mesh(new THREE.BoxGeometry(0.08, 0.15, 0.6), matWhiteAccent); intakeL.position.set(-1.05, 0.4, 0.5);
            const intakeR = new THREE.Mesh(new THREE.BoxGeometry(0.08, 0.15, 0.6), matWhiteAccent); intakeR.position.set(1.05, 0.4, 0.5);
            car.add(intakeL, intakeR);

            // 9. Lightweight alloy wheels (silver/white accent)
            const wheelGeo = new THREE.CylinderGeometry(0.42, 0.42, 0.38, 16); wheelGeo.rotateZ(Math.PI / 2);
            const wheelCapGeo = new THREE.CylinderGeometry(0.18, 0.18, 0.4, 8); wheelCapGeo.rotateZ(Math.PI / 2);
            [[-1.05, 0.42, 1.4], [1.05, 0.42, 1.4], [-1.05, 0.42, -1.4], [1.05, 0.42, -1.4]].forEach(pos => {
                const wheel = new THREE.Mesh(wheelGeo, matDark);
                wheel.position.set(...pos); wheel.castShadow = true; car.add(wheel);
                // White center cap
                const cap = new THREE.Mesh(wheelCapGeo, matWheelSilver);
                cap.position.set(...pos); car.add(cap);
            });

            return car;
        }

        // Heavy-duty mechanical delivery transporter for macet/traffic
        function createHeavyCyberHauler() {
            const truck = new THREE.Group();
            const matTruckBody = new THREE.MeshStandardMaterial({ color: 0x8fa382, roughness: 0.5, metalness: 0.5, flatShading: true });

            const cabin = new THREE.Mesh(new THREE.BoxGeometry(2.3, 1.4, 2.0), matDark);
            cabin.position.set(0, 0.9, -1.3); cabin.castShadow = true;
            
            const cargo = new THREE.Mesh(new THREE.BoxGeometry(2.4, 1.7, 3.8), matTruckBody);
            cargo.position.set(0, 1.15, 1.3); cargo.castShadow = true;

            const trim = new THREE.Mesh(new THREE.BoxGeometry(2.32, 0.2, 1.94), matWood);
            trim.position.set(0, 0.28, -1.3);

            truck.add(cabin, cargo, trim);

            const wheelGeo = new THREE.CylinderGeometry(0.55, 0.55, 0.46, 12);
            wheelGeo.rotateZ(Math.PI / 2);
            [[-1.15, 0.55, 1.7], [1.16, 0.55, 1.7], [-1.15, 0.55, 0.3], [1.16, 0.55, 0.3], [-1.15, 0.55, -1.5], [1.16, 0.55, -1.5]].forEach(pos => {
                const w = new THREE.Mesh(wheelGeo, matDark); w.castShadow = true;
                w.position.set(...pos); truck.add(w);
            });

            return truck;
        }

        // Spawn Player's Sports Racer (Racing Blue + White)
        const playerCar = createSleekSportsCar(0x2980b9, true);
        scene.add(playerCar);

        // Add physical active taillight brake flare mesh inside player car
        const activeBrakeLightL = new THREE.Mesh(new THREE.BoxGeometry(0.52, 0.12, 0.12), matTaillightBrake);
        activeBrakeLightL.position.set(-0.5, 0.45, 2.54); activeBrakeLightL.visible = false;
        const activeBrakeLightR = new THREE.Mesh(new THREE.BoxGeometry(0.52, 0.12, 0.12), matTaillightBrake);
        activeBrakeLightR.position.set(0.5, 0.45, 2.54); activeBrakeLightR.visible = false;
        playerCar.add(activeBrakeLightL, activeBrakeLightR);

        // Add real PointLight to illuminate ground when pengereman
        const brakePointLight = new THREE.PointLight(0xff0000, 0, 8);
        brakePointLight.position.set(0, 0.5, 2.5);
        playerCar.add(brakePointLight);

        // ==========================================
        // TURN SIGNAL / HAZARD LIGHTS (Auto-activate on steering)
        // ==========================================
        const matBlinkerAmber = new THREE.MeshBasicMaterial({ color: 0xff9f43, transparent: true, opacity: 0.3 });

        // Front-left blinker
        const blinkerFL = new THREE.Mesh(new THREE.BoxGeometry(0.25, 0.12, 0.12), matBlinkerAmber.clone());
        blinkerFL.position.set(-1.0, 0.45, -2.45);
        // Front-right blinker
        const blinkerFR = new THREE.Mesh(new THREE.BoxGeometry(0.25, 0.12, 0.12), matBlinkerAmber.clone());
        blinkerFR.position.set(1.0, 0.45, -2.45);
        // Rear-left blinker
        const blinkerRL = new THREE.Mesh(new THREE.BoxGeometry(0.25, 0.12, 0.12), matBlinkerAmber.clone());
        blinkerRL.position.set(-1.0, 0.45, 2.48);
        // Rear-right blinker
        const blinkerRR = new THREE.Mesh(new THREE.BoxGeometry(0.25, 0.12, 0.12), matBlinkerAmber.clone());
        blinkerRR.position.set(1.0, 0.45, 2.48);

        playerCar.add(blinkerFL, blinkerFR, blinkerRL, blinkerRR);

        // Amber PointLights for each side
        const signalLightL = new THREE.PointLight(0xffa500, 0, 6);
        signalLightL.position.set(-1.1, 0.5, 0);
        const signalLightR = new THREE.PointLight(0xffa500, 0, 6);
        signalLightR.position.set(1.1, 0.5, 0);
        playerCar.add(signalLightL, signalLightR);

        // Signal state
        let signalLeft = false;
        let signalRight = false;
        let signalBlinkFrame = 0;
        let signalBlinkOn = false;

        const btnLeft = document.getElementById('btn-left');
        const btnRight = document.getElementById('btn-right');

        function updateSignalBlinkers() {
            // Auto-activate signals based on steering input
            signalLeft = keys.ArrowLeft;
            signalRight = keys.ArrowRight;

            // Update D-pad button glow
            btnLeft.classList.toggle('signal-active', signalLeft);
            btnRight.classList.toggle('signal-active', signalRight);

            // Blinking logic
            signalBlinkFrame++;
            if (signalBlinkFrame >= 18) {
                signalBlinkFrame = 0;
                signalBlinkOn = !signalBlinkOn;
            }

            const leftOn = signalLeft && signalBlinkOn;
            const rightOn = signalRight && signalBlinkOn;

            // Front/rear left blinkers
            blinkerFL.material.opacity = leftOn ? 1.0 : 0.3;
            blinkerFL.material.color.setHex(leftOn ? 0xffa500 : 0xff9f43);
            blinkerRL.material.opacity = leftOn ? 1.0 : 0.3;
            blinkerRL.material.color.setHex(leftOn ? 0xffa500 : 0xff9f43);
            signalLightL.intensity = leftOn ? 2.5 : 0;

            // Front/rear right blinkers
            blinkerFR.material.opacity = rightOn ? 1.0 : 0.3;
            blinkerFR.material.color.setHex(rightOn ? 0xffa500 : 0xff9f43);
            blinkerRR.material.opacity = rightOn ? 1.0 : 0.3;
            blinkerRR.material.color.setHex(rightOn ? 0xffa500 : 0xff9f43);
            signalLightR.intensity = rightOn ? 2.5 : 0;
        }

        // ==========================================
        // 6. SCENERY CONSTRUCTIONS - LOW POLY ORGANIC
        // ==========================================
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
            const pole = new THREE.Mesh(new THREE.CylinderGeometry(0.1, 0.1, 4, 8), matPole);
            pole.position.y = 2; pole.castShadow = true;
            const top = new THREE.Mesh(new THREE.BoxGeometry(1.5, 0.2, 0.3), matPole);
            top.position.set(0.6, 4, 0); top.castShadow = true;
            const bulb = new THREE.Mesh(new THREE.SphereGeometry(0.15, 8, 8), new THREE.MeshBasicMaterial({color: 0xffeaa7}));
            bulb.position.set(1.2, 3.9, 0);
            lamp.add(pole); lamp.add(top); lamp.add(bulb); return lamp;
        }

        let worldObjects = [];
        let fireParticles = []; // Drifting yellow/orange smoke
        let sparkParticles = []; // Classic flame sparks

        function spawnEnvironment() {
            // Sliding central white telemetry line
            const line = new THREE.Mesh(new THREE.PlaneGeometry(0.2, 2.5), matLine);
            line.rotation.x = -Math.PI / 2; line.position.set(0, 0.02, -150);
            scene.add(line); worldObjects.push(line);

            // Spawning organic trees and lamp posts
            if(Math.random() > 0.28) { 
                const treeL = createLowPolyTree(); 
                treeL.position.set(-7.5 - Math.random()*9, 0, -150); 
                scene.add(treeL); worldObjects.push(treeL); 
            }
            if(Math.random() > 0.28) { 
                const treeR = createLowPolyTree(); 
                treeR.position.set(7.5 + Math.random()*9, 0, -150); 
                scene.add(treeR); worldObjects.push(treeR); 
            }
            if(Math.random() > 0.8) { 
                const lamp = createLampPost(); 
                lamp.position.set(-6.4, 0, -150); 
                scene.add(lamp); worldObjects.push(lamp); 
            }
        }

        // ==========================================
        // 7. SPECIFIC CHOSEN SCENARIOS (TACTILE & HUMAN HANDS)
        // ==========================================
        
        // Scene A: Accident (190m) — Reverted to "BEFORE" layout (flipped blue car + crashed black car + wooden barriers)
        function createAccident() {
            const group = new THREE.Group();
            
            // Flipped blue concept sports car
            const car1 = createSleekSportsCar(0x0984e3); 
            car1.rotation.z = Math.PI; 
            car1.rotation.y = Math.PI/6;
            car1.position.set(-2, 0.8, 0); 
            
            // Smashed black concept coupe
            const car2 = createSleekSportsCar(0x2d3436); 
            car2.rotation.y = -Math.PI/4;
            car2.position.set(-3.5, 0, 3);
            
            group.add(car1, car2);

            // Classic caution wooden barriers
            const barrier1 = new THREE.Mesh(new THREE.BoxGeometry(3.5, 0.6, 0.3), matWood);
            barrier1.position.set(-1.8, 0.3, -3); barrier1.castShadow = true;
            group.add(barrier1);

            // Natural, organic expanding fire particles
            const fireGeo = new THREE.TetrahedronGeometry(0.48);
            const fireMat = new THREE.MeshBasicMaterial({ color: 0xff7675, transparent: true, opacity: 0.85 });
            for(let i=0; i<40; i++) {
                const p = new THREE.Mesh(fireGeo, fireMat.clone());
                p.position.set(-2.5 + (Math.random()-0.5)*2.2, 0.2 + Math.random()*2, 1.5 + (Math.random()-0.5)*2.2);
                p.userData = { life: Math.random(), speed: 0.035 + Math.random()*0.05, scale: Math.random()*0.55 + 0.45 };
                group.add(p); fireParticles.push(p); 
            }

            // Warm fire PointLight
            const fLight = new THREE.PointLight(0xff7675, 2.5, 14);
            fLight.position.set(-2.5, 1, 1.5);
            group.add(fLight);
            
            group.userData = { light: fLight, tick: 0 };

            group.position.set(-1, 0, -120); 
            scene.add(group); worldObjects.push({mesh: group, isEvent: true});
        }

        // Scene B: Traffic (490m) — Kept "NOW" layout (high-fidelity queue: Cyber-Hauler + Hypercars)
        function createTraffic() {
            const group = new THREE.Group();
            
            // Cyber-hauler leads
            const hauler = createHeavyCyberHauler();
            hauler.position.set(3, 0, -11);
            
            // Aero-prototype follows close
            const prototypeY = createSleekSportsCar(0xf1c40f);
            prototypeY.position.set(3, 0, 0);

            // Sleek hypercar trails
            const prototypeP = createSleekSportsCar(0x8e44ad);
            prototypeP.position.set(3, 0, 10.5);

            group.add(hauler, prototypeY, prototypeP);
            group.position.set(0, 0, -120);
            scene.add(group); worldObjects.push({mesh: group, isEvent: true});
        }

        // Scene C: Pit Stop (640m) — Reverted to "BEFORE" layout (simple branch road + red roof + dark pillars)
        function createPitStopArea() {
            const group = new THREE.Group();
            
            // Offroad asphalt branch
            const branch = new THREE.Mesh(new THREE.PlaneGeometry(8, 20), matRoad);
            branch.rotation.x = -Math.PI/2; branch.position.set(-8, 0.015, 0);
            
            // Classic F1 Red Canopy roof
            const roof = new THREE.Mesh(new THREE.BoxGeometry(10, 0.5, 6), new THREE.MeshStandardMaterial({color:0xff7675, flatShading: true}));
            roof.position.set(-8, 4, 0); roof.castShadow = true;
            
            // Simple metallic pillars
            const p1 = new THREE.Mesh(new THREE.CylinderGeometry(0.18, 0.18, 4), matDark); p1.position.set(-12.2, 2, -2);
            const p2 = new THREE.Mesh(new THREE.CylinderGeometry(0.18, 0.18, 4), matDark); p2.position.set(-3.8, 2, -2);
            
            group.add(branch, roof, p1, p2);
            group.position.set(0, 0, -120);
            scene.add(group); worldObjects.push({mesh: group, isEvent: true, isPitstop: true});
        }

        // Scene D: Damaged Road (790m) — Kept "NOW" layout (detailed potholes + hazard cones)
        function createPotholes() {
            const group = new THREE.Group();
            const holeMat = new THREE.MeshBasicMaterial({color: 0x1a1a1a});
            
            // Detailed asphalt pothole cracks
            const h1 = new THREE.Mesh(new THREE.CircleGeometry(1.2, 8), holeMat); h1.rotation.x = -Math.PI/2; h1.position.set(3, 0.02, 0);
            const h2 = new THREE.Mesh(new THREE.CircleGeometry(0.8, 6), holeMat); h2.rotation.x = -Math.PI/2; h2.position.set(2, 0.02, 3);
            const h3 = new THREE.Mesh(new THREE.CircleGeometry(1.5, 7), holeMat); h3.rotation.x = -Math.PI/2; h3.position.set(4, 0.02, -2);
            
            group.add(h1, h2, h3);

            // Warning traffic caution cones blocking the damage lanes
            const coneMat = new THREE.MeshStandardMaterial({color: 0xff5e00, roughness: 0.5});
            const coneWhite = new THREE.MeshBasicMaterial({color: 0xffffff});
            
            [ [3, 0], [2, 3], [4, -2] ].forEach(pos => {
                const cone = new THREE.Group();
                const base = new THREE.Mesh(new THREE.BoxGeometry(0.55, 0.04, 0.55), coneMat); base.castShadow = true;
                const body = new THREE.Mesh(new THREE.ConeGeometry(0.2, 0.72, 6), coneMat); body.position.y = 0.36; body.castShadow = true;
                const strip = new THREE.Mesh(new THREE.CylinderGeometry(0.12, 0.15, 0.18, 6), coneWhite); strip.position.y = 0.4;
                cone.add(base, body, strip);
                cone.position.set(pos[0], 0.02, pos[1]);
                group.add(cone);
            });

            group.position.set(0, 0, -120);
            scene.add(group); worldObjects.push({mesh: group, isEvent: true});
        }

        // ==========================================
        // 8. STATE & GAMEPLAY CONTROL ENGINE
        // ==========================================
        let speed = 0.45;
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
        setupDriveBtn('btn-left', 'ArrowLeft'); setupDriveBtn('btn-right', 'ArrowRight'); setupDriveBtn('btn-brake', 'ArrowDown'); setupDriveBtn('btn-gas', 'ArrowUp');

        document.getElementById('btn-start-game').onclick = () => {
            document.getElementById('start-overlay').style.display = 'none';
            isPaused = false; startTime = Date.now();
        };
        
        document.getElementById('pause-btn').onclick = () => {
            const isAnyModalOpen = document.getElementById('quiz-panel').style.display === 'block' || 
                                   document.getElementById('finish-overlay').style.display === 'flex' ||
                                   document.getElementById('start-overlay').style.display === 'flex' ||
                                   document.getElementById('pause-overlay').style.display === 'flex';
            if(!isGameOver && !hasHitFinishLine && !isAnyModalOpen) { 
                isPaused = true;
                document.getElementById('pause-overlay').style.display = 'flex';
            }
        };

        document.getElementById('btn-resume-game').onclick = () => {
            const pauseCard = document.querySelector('#pause-overlay .modal-card');
            let count = 3;
            const countdownEl = document.createElement('div');
            countdownEl.className = 'tech-title';
            countdownEl.style.fontSize = '4rem';
            countdownEl.style.marginTop = '10px';
            countdownEl.style.color = 'var(--brand-cyan)';
            pauseCard.appendChild(countdownEl);
            
            const interval = setInterval(() => {
                countdownEl.innerText = count;
                count--;
                if(count < 0) {
                    clearInterval(interval);
                    countdownEl.remove();
                    document.getElementById('pause-overlay').style.display = 'none';
                    isPaused = false;
                }
            }, 1000);
        };

        document.getElementById('close-finish-btn').onclick = () => { window.location.href = '/finish-line'; };

        function triggerGameOver() {
            isGameOver = true;
            isPaused = true;
            showToast("GAME OVER! Bensin Habis.", "error");
            document.getElementById('gameover-overlay').style.display = 'flex';
        }

        document.getElementById('btn-restart-game').onclick = () => {
            window.location.reload();
        };

        document.getElementById('btn-exit-game').onclick = () => {
            window.location.href = '/';
        };

        // ==========================================
        // 9. TELEMETRY COGNITIVE CHALLENGES
        // ==========================================
        let currentQuizMode = ''; 
        let articleQuizzes = [];
        let pitStopQs = [];

        // Fetch dynamic quizzes from database API (public endpoint)
        async function fetchQuizzes() {
            try {
                const res = await fetch('/api/quizzes', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) {
                    console.warn('Quiz fetch failed with status:', res.status);
                    return;
                }
                const json = await res.json();
                if (json.data && json.data.length > 0) {
                    const dbObstacles = json.data.filter(q => q.quiz_type === 'obstacle');
                    const dbPitstops = json.data.filter(q => q.quiz_type === 'pitstop');

                    // Map dynamic Obstacle Quizzes
                    if (dbObstacles.length > 0) {
                        articleQuizzes = dbObstacles.map(q => {
                            let dist = 200;
                            let title = "YELLOW FLAG";
                            if (q.obstacle_type === 'racing_line') { dist = 500; title = "RACING LINE"; }
                            if (q.obstacle_type === 'brake_zone') { dist = 800; title = "BRAKE ZONE"; }

                            const options = [
                                { t: q.option_a, c: q.correct_answer === 'A' },
                                { t: q.option_b, c: q.correct_answer === 'B' },
                                { t: q.option_c, c: q.correct_answer === 'C' }
                            ];
                            if (q.option_d) options.push({ t: q.option_d, c: q.correct_answer === 'D' });
                            while (options.length < 4) options.push({ t: '-', c: false });

                            return {
                                dist: dist,
                                title: title,
                                points: q.points || 10,
                                q: q.question,
                                a: options,
                                triggered: false
                            };
                        });
                    }

                    // Map dynamic Pit Stop Quizzes
                    if (dbPitstops.length > 0) {
                        pitStopQs = dbPitstops.map((q, idx) => {
                            const options = [
                                { t: q.option_a, c: q.correct_answer === 'A' },
                                { t: q.option_b, c: q.correct_answer === 'B' },
                                { t: q.option_c, c: q.correct_answer === 'C' }
                            ];
                            if (q.option_d) options.push({ t: q.option_d, c: q.correct_answer === 'D' });
                            while (options.length < 4) options.push({ t: '-', c: false });

                            return {
                                q: `(${idx+1}/${dbPitstops.length}) ${q.question}`,
                                points: q.points || 10,
                                a: options
                            };
                        });
                    }
                }
            } catch (err) {
                console.warn("Dynamic quizzes fetch error, falling back to static lists.", err);
            }
        }
        fetchQuizzes();

        let pitIndex = 0; let pitTimer; let timeLeft = 100;
                let pitCorrectCount = 0; // Track correct answers during pit stop
        const qPanel = document.getElementById('quiz-panel');
        const qBtns = document.querySelectorAll('.quiz-btn');

        let activeQuizPoints = 10; // Track points for current quiz from CRUD data

        function showQuizPanel() {
            qPanel.style.display = 'block';
        }
        function hideQuizPanel() {
            qPanel.style.display = 'none';
        }

        function triggerQuiz(qData) {
            currentQuizMode = 'article'; isPaused = true; qData.triggered = true;
            activeQuizPoints = qData.points || 10;
            document.getElementById('timer-bar-wrap').style.display = 'none';
            document.getElementById('quiz-title').innerText = qData.title;
            document.getElementById('quiz-question').innerText = qData.q;
            qBtns.forEach((btn, i) => { btn.innerText = qData.a[i].t; btn.setAttribute('data-correct', qData.a[i].c); });
            showQuizPanel();
        }

        function triggerPitStop() {
            if (hasDonePitStop) return; 
            currentQuizMode = 'pitstop'; isPaused = true; hasDonePitStop = true; pitIndex = 0;
            pitCorrectCount = 0; // Reset correct answer counter
            playerCar.position.x = -8; 
            showQuizPanel(); loadPitQ();
        }

        function loadPitQ() {
            clearInterval(pitTimer); timeLeft = 100; document.getElementById('timer-bar-fill').style.width = "100%";
            document.getElementById('timer-bar-wrap').style.display = 'block';
            document.getElementById('quiz-title').innerText = "PIT STOP";
            document.getElementById('quiz-question').innerText = pitStopQs[pitIndex].q;
            qBtns.forEach((btn, i) => { btn.innerText = pitStopQs[pitIndex].a[i].t; btn.setAttribute('data-correct', pitStopQs[pitIndex].a[i].c); });
            
            pitTimer = setInterval(() => {
                timeLeft -= 1.4; document.getElementById('timer-bar-fill').style.width = timeLeft + "%";
                if(timeLeft <= 0) { clearInterval(pitTimer); handlePitAnswer(false); }
            }, 100);
        }

        function handlePitAnswer(isCorrect) {
            clearInterval(pitTimer);
            if(isCorrect) { 
                pitCorrectCount++;
                score += 10;
                showToast(`Benar! (${pitCorrectCount} tepat)`, "success"); 
            } else { 
                showToast("Salah / Waktu Habis!", "error"); 
            }
            
            pitIndex++;
            if(pitIndex < pitStopQs.length) {
                loadPitQ();
            } else {
                // Set fuel based on correct answer count
                // 3 correct = 100% (full tank, comfortable finish)
                // 2 correct = 50%  (can finish at normal speed, but accelerating burns more)
                // 1 correct = 25%  (can drive but can't reach finish)
                // 0 correct = 0%   (immediate game over)
                const fuelMap = { 0: 0, 1: 25, 2: 75, 3: 100 };
                gas = fuelMap[pitCorrectCount] || 0;

                hideQuizPanel(); currentQuizMode = '';
                if(gas <= 0) { 
                    showToast("Bensin habis! Pit stop gagal total.", "error");
                    triggerGameOver();
                } else { 
                    const msgs = {
                        3: "Pit Stop Sempurna! Bensin penuh 100%!",
                        2: "Pit Stop cukup baik! Bensin 70% — hemat ya!",
                        1: "Pit Stop kurang baik. Bensin hanya 25%..."
                    };
                    showToast(msgs[pitCorrectCount] || "", pitCorrectCount >= 2 ? "success" : "error"); 
                    playerCar.position.x = 0; isPaused = false; 
                } 
            }
        }

        qBtns.forEach(btn => {
            btn.onclick = (e) => {
                const isCorrect = e.target.getAttribute('data-correct') === 'true';
                if (currentQuizMode === 'article') {
                    const pts = activeQuizPoints;
                    if(isCorrect) { 
                        score += pts; showToast(`Jawaban Tepat! +${pts} Poin.`, "success"); 
                    } else { 
                        score -= pts; showToast(`Jawaban Salah! -${pts} Poin.`, "error"); 
                    }
                    document.getElementById('score-ui').innerText = score;
                    hideQuizPanel(); currentQuizMode = ''; isPaused = false;
                } else if (currentQuizMode === 'pitstop') {
                    handlePitAnswer(isCorrect);
                }
            };
        });

        // ==========================================
        // 10. REAL-TIME GAME CLOCK & RENDERING
        // ==========================================
        function animate() {
            requestAnimationFrame(animate);

            if (!isPaused && !isGameOver && !hasHitFinishLine) {
                // Taillight active reaction
                const braking = keys.ArrowDown;
                const accelerating = keys.ArrowUp;
                activeBrakeLightL.visible = braking;
                activeBrakeLightR.visible = braking;
                brakePointLight.intensity = braking ? 2.0 : 0;

                // Update turn signal blinkers
                updateSignalBlinkers();

                // Auto-slowdown when a scene/event is approaching (within z=-80 to z=10)
                let sceneNearby = false;
                for (let i = 0; i < worldObjects.length; i++) {
                    const obj = worldObjects[i];
                    if (obj.isEvent) {
                        const mesh = obj.mesh || obj;
                        if (mesh.position.z < -10 && mesh.position.z > -80) {
                            sceneNearby = true;
                            break;
                        }
                    }
                }

                let moveSpeed;
                if (braking) {
                    moveSpeed = speed * 0.4;
                } else if (accelerating) {
                    moveSpeed = speed * 2.2;
                } else {
                    moveSpeed = speed;
                }
                // Auto-slowdown when scene is approaching
                if (sceneNearby && !braking) {
                    moveSpeed = Math.min(moveSpeed, speed * 0.55);
                }
                distance += (moveSpeed * 0.2); 
                let currentDist = Math.floor(distance);
                document.getElementById('distance-ui').innerText = currentDist;
                // UI speed: base speed shows 60 km/h, accelerating capped at 99 km/h
                const displaySpeed = Math.min(99, Math.round(moveSpeed / speed * 60));
                document.getElementById('speed-ui').innerText = displaySpeed;

                envSpawnTimer++;
                if(envSpawnTimer > 30 / moveSpeed) { spawnEnvironment(); envSpawnTimer = 0; }

                for (let i = worldObjects.length - 1; i >= 0; i--) {
                    let obj = worldObjects[i];
                    let mesh = obj.mesh || obj; 
                    mesh.position.z += moveSpeed;
                    
                    if(obj.isEvent && Math.abs(mesh.position.z) < 1.2) {
                        if(obj.isPitstop) triggerPitStop();
                        obj.isEvent = false; 
                    }

                    // Flicker accident fire lights
                    if (mesh.userData && mesh.userData.light) {
                        mesh.userData.tick += 0.15;
                        mesh.userData.light.intensity = 2.0 + Math.sin(mesh.userData.tick) * 0.5;
                    }

                    if (mesh.position.z > 20) {
                        scene.remove(mesh); worldObjects.splice(i, 1);
                    }
                }

                // Natural fire particle drift animations
                if (fireParticles.length > 0) {
                    fireParticles.forEach(p => {
                        if (p.parent) {
                            p.position.y += p.userData.speed;
                            p.userData.life -= 0.022;
                            p.scale.setScalar(p.userData.life * p.userData.scale);
                            
                            if(p.userData.life <= 0) {
                                p.position.y = 0.2; 
                                p.userData.life = 1;
                            }
                            
                            // Cream Yellow -> Orange -> Ash grey
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

                articleQuizzes.forEach(q => { if(!q.triggered && currentDist >= q.dist + 7) triggerQuiz(q); });

                if (!hasDonePitStop) {
                    // Pre-pit: fuel drains linearly, but player arrives at pit (~640m) with ~12% fuel
                    gas = 100 - (distance / 730) * 100;
                    if(gas <= 0) {
                        gas = 0;
                        triggerGameOver();
                    }
                } else if (currentQuizMode !== 'pitstop') { 
                    // Post-pit: fuel drains proportionally to distance traveled
                    // Normal: 0.20 fuel/m → 100 fuel = 500m range (easily finishes 360m)
                    // Accelerating: 0.35 fuel/m → 100 fuel = 286m (risky, burns fast)
                    // Braking: 0.10 fuel/m → 100 fuel = 1000m (very efficient)
                    // 2 correct (50 fuel): normal=250m (not enough), braking=500m (can finish)
                    // 1 correct (25 fuel): braking=250m (still can't reach 360m finish)
                    const fuelPerMeter = accelerating ? 0.35 : (braking ? 0.10 : 0.20);
                    const distTraveled = moveSpeed * 0.2;
                    gas -= fuelPerMeter * distTraveled;
                    if(gas <= 0) {
                        gas = 0;
                        triggerGameOver();
                    }
                }
                
                const gasFill = document.getElementById('gas-fill');
                gasFill.style.width = gas + "%";
                gasFill.style.background = gas < 30 ? "linear-gradient(90deg, var(--brand-brick-red), #e74c3c)" : "linear-gradient(90deg, var(--brand-sage), var(--brand-sage-dark))";
                
                const fuelPercent = document.getElementById('fuel-percentage-ui');
                if (fuelPercent) fuelPercent.innerText = Math.round(gas) + "%";

                // Turning & Steering
                const turnSpeed = 0.15;
                if (keys.ArrowLeft && playerCar.position.x > -4.5) playerCar.position.x -= turnSpeed;
                if (keys.ArrowRight && playerCar.position.x < 4.5) playerCar.position.x += turnSpeed;
                
                // Spin wheels mesh over velocity
                playerCar.children.forEach(w => {
                    if (w.geometry && w.geometry.type === 'CylinderGeometry') {
                        w.rotation.x -= moveSpeed * 0.1;
                    }
                });

                // ==========================================
                // FINISH LINE SEQUENCER
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
                        headers: { 
                            'Content-Type': 'application/json', 
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                        },
                        body: JSON.stringify({ score: score, best_time: bestTimeStr })
                    }).then(res => res.json()).then(data => {
                        document.getElementById('saving-status').innerHTML = `Data tersimpan!<br>Waktu kamu: <b>${bestTimeStr}</b>`;
                        document.getElementById('saving-status').style.color = "var(--brand-taupe-dark)"; 
                        document.getElementById('close-finish-btn').style.display = "block";
                    }).catch(err => {
                        document.getElementById('saving-status').innerText = "Gagal menyimpan skor ke server.";
                        document.getElementById('saving-status').style.color = "var(--brand-brick-red)";
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