
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