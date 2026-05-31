@extends('app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
@endsection

@section('content')

<div class="ls-page-wrapper" data-stage="3">
    <div class="ls-container">
        
        <!-- MAIN PAGE GRID -->
        <div class="ls-grid">
            
            <!-- LEFT COLUMN: EDITORIAL CONTENT -->
            <main class="ls-main-content">
                
                <!-- HERO HEADER -->
                <header class="ls-hero">
                    <div class="ls-hero-watermark">03</div>
                    <div class="ls-hero-tag">Stage 3 • Racing Line</div>
                    <h1>Racing Line —<br>Jalur Terbaik Bukan yang Tercepat,<br>tapi yang Paling Aman</h1>
                    <p class="ls-hero-desc">
                        Di dunia balap, racing line adalah lintasan matematis optimal untuk melaju secepat mungkin. 
                        Namun di jalan raya umum, konsep ini direduksi menjadi satu tujuan mulia: 
                        <strong>memosisikan kendaraan Anda di tempat terbaik agar selalu memiliki ruang dan waktu untuk bereaksi.</strong>
                    </p>
                </header>

                <!-- SECTION 1: THE PRINCIPLE OF POSITIONING -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Memaksimalkan Jarak Pandang & Grip</h2>
                    
                    <div class="ls-editorial-spread">
                        <div class="ls-editorial-panel">
                            <h3>Bukan Soal Memotong Jalan</h3>
                            <p>
                                Banyak pengendara awam memotong tikungan masuk ke lajur berlawanan dengan anggapan "memperpendek jarak sirkuit". Di jalan raya umum yang memiliki arus dua arah, memotong marka garis tengah adalah tindakan mematikan. Jalur terbaik di jalan raya adalah jalur yang menahan Anda tetap aman di lajur sendiri sembari memaksimalkan pandangan ke depan tikungan (line of sight).
                            </p>
                        </div>
                        
                        <div class="ls-editorial-panel">
                            <h3>Distribusi Grip Fisika</h3>
                            <p>
                                Ban kendaraan memiliki batas maksimal cengkeraman (grip circle). Jika Anda memaksa berbelok tajam sekaligus mengerem keras di tengah tikungan, ban akan kehilangan grip secara instan. Racing line membagi beban grip secara berurutan: pengereman diselesaikan di lintasan lurus, diikuti kemudi halus, lalu akselerasi keluar.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- INTERACTIVE WIDGET: APEX PATH EXPLORER -->
                <section class="ls-widget-container">
                    <div class="ls-widget-header">
                        <h3>Interactive Apex Path Explorer</h3>
                        <p>Klik langkah-langkah di kanan untuk menganalisis jalur tikungan secara visual di peta sirkuit.</p>
                    </div>
                    
                    <div class="ls-apex-explorer">
                        <!-- Left: Live SVG Circuit Corner Visualizer -->
                        <div class="ls-explorer-svg">
                            <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                                <!-- Track Borders -->
                                <path d="M 50,300 C 50,150 150,50 400,50" fill="none" stroke="#2a2622" stroke-width="60" stroke-linecap="square"/>
                                <path d="M 50,300 C 50,150 150,50 400,50" fill="none" stroke="#3f3a36" stroke-width="50" stroke-linecap="square"/>
                                
                                <!-- Center Dashed Line -->
                                <path d="M 50,300 C 50,150 150,50 400,50" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1.5" stroke-dasharray="10,8"/>
                                
                                <!-- Racing Line Paths -->
                                <path id="path-entry" d="M 25,300 L 25,230" fill="none" stroke="transparent" stroke-width="8" stroke-linecap="round"/>
                                <path id="path-brake" d="M 25,230 L 25,170" fill="none" stroke="transparent" stroke-width="8" stroke-linecap="round"/>
                                <path id="path-apex" d="M 25,170 C 25,110 110,25 250,25" fill="none" stroke="transparent" stroke-width="8" stroke-linecap="round"/>
                                <path id="path-exit" d="M 250,25 L 400,25" fill="none" stroke="transparent" stroke-width="8" stroke-linecap="round"/>

                                <!-- Decorative Racetrack Path overlay -->
                                <path id="racing-line-glow" d="M 25,300 L 25,200 C 25,100 100,25 250,25 L 400,25" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="4"/>

                                <!-- Digital Car Node -->
                                <circle id="car-node" cx="25" cy="300" r="8" fill="#3b82f6" stroke="#fff" stroke-width="2" style="box-shadow: 0 0 10px #3b82f6; transition: all 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);"/>
                            </svg>
                        </div>
                        
                        <!-- Right: Interactive Buttons -->
                        <div class="ls-explorer-btns">
                            <button class="ls-explorer-btn active" onclick="highlightStep(1, 25, 260, 'path-entry')" id="btn-step1">
                                <h4>Step 1: Late Apex Entry</h4>
                                <p>Masuk tikungan dari lajur luar untuk memperluas radius berbelok.</p>
                            </button>
                            <button class="ls-explorer-btn" onclick="highlightStep(2, 25, 200, 'path-brake')" id="btn-step2">
                                <h4>Step 2: Braking Point</h4>
                                <p>Selesaikan seluruh proses rem di trek lurus sebelum memutar setir.</p>
                            </button>
                            <button class="ls-explorer-btn" onclick="highlightStep(3, 100, 75, 'path-apex')" id="btn-step3">
                                <h4>Step 3: Smooth Apex</h4>
                                <p>Putar setir secara progresif di titik terdalam tikungan (apex).</p>
                            </button>
                            <button class="ls-explorer-btn" onclick="highlightStep(4, 320, 25, 'path-exit')" id="btn-step4">
                                <h4>Step 4: Exit Speed</h4>
                                <p>Luruskan roda, lalu akselerasi perlahan keluar tikungan.</p>
                            </button>
                        </div>
                    </div>
                </section>

                <!-- SECTION 2: 4 PRINCIPLES VERTICAL TIMELINE -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">4 Prinsip Racing Line di Jalan Raya</h2>
                    
                    <div class="ls-timeline">
                        <div class="ls-timeline-item">
                            <div class="ls-timeline-dot"></div>
                            <span class="ls-timeline-number">Prinsip 01</span>
                            <h3>Late Apex — Masuk Tikungan dari Luar</h3>
                            <p>Jangan pernah memotong tikungan (cutting corner). Selalu masuk dari sisi terluar lajur Anda sendiri, tempel bagian dalam tikungan di tengah jalan, dan biarkan kendaraan melebar secara alami tapi tetap berada di dalam lajur sendiri. Memotong lajur berlawanan berisiko tabrakan fatal.</p>
                        </div>
                        
                        <div class="ls-timeline-item">
                            <div class="ls-timeline-dot"></div>
                            <span class="ls-timeline-number">Prinsip 02</span>
                            <h3>Braking Point — Rem Sebelum Tikungan</h3>
                            <p>Melakukan pengereman di tengah tikungan adalah kesalahan mekanis fatal. Ketika setir berputar, ban sudah terbebani gaya lateral. Menekan rem di titik ini akan membuat grip ban habis seketika. Selesaikan pengereman penuh saat kendaraan masih melaju lurus <em>sebelum</em> berbelok.</p>
                        </div>
                        
                        <div class="ls-timeline-item">
                            <div class="ls-timeline-dot"></div>
                            <span class="ls-timeline-number">Prinsip 03</span>
                            <h3>Smooth Steering — Putaran Kemudi Halus</h3>
                            <p>Input kemudi yang menghentak tiba-tiba (jerky) akan mengacaukan pusat gravitasi kendaraan (weight transfer). Lakukan manuver memutar setir secara progresif, lembut, dan terencana, terutama pada kondisi permukaan jalan basah, berpasir, atau berlubang.</p>
                        </div>
                        
                        <div class="ls-timeline-item">
                            <div class="ls-timeline-dot"></div>
                            <span class="ls-timeline-number">Prinsip 04</span>
                            <h3>Exit Speed — Akselerasi Bertahap</h3>
                            <p>Akselerasi atau menge-gas kendaraan paling aman dilakukan setelah ban depan kembali dalam posisi lurus. Menekan gas terlalu dalam saat ban masih membelok akan memicu kehilangan traksi (understeer pada penggerak depan, oversteer pada penggerak belakang) yang melempar kendaraan ke bahu jalan.</p>
                        </div>
                    </div>
                </section>

                <hr class="ls-divider">

                <!-- SECTION 3: DEEP LEARNING REFERENCES -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Deep Learning & References</h2>
                    
                    <div class="ls-ref-grid">
                        <div class="ls-ref-card">
                            <div>
                                <span class="ls-ref-tag">Referensi • Video</span>
                                <h4>"The Physics of F1 Cornering" — Engineering Explained</h4>
                                <p>Video edukasi fisika terapan yang sangat rinci menjelaskan interaksi ban dengan aspal, slip angle, understeer/oversteer, dan transfer beban saat melintasi tikungan.</p>
                            </div>
                            <a href="https://www.youtube.com/@EngineeringExplained" target="_blank" class="ls-ref-link">
                                Tonton di YouTube
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                        
                        <div class="ls-ref-card">
                            <div>
                                <span class="ls-ref-tag">Data Statistik • Korlantas</span>
                                <h4>72% Kecelakaan di Tikungan Karena Salah Lajur</h4>
                                <p>Data Korlantas Polri menunjukkan mayoritas kecelakaan fatal di tikungan jalan nasional dipicu bukan karena kecepatan berlebih semata, melainkan karena kendaraan melambung keluar lajur aman.</p>
                            </div>
                            <a href="https://korlantas.polri.go.id" target="_blank" class="ls-ref-link">
                                Kunjungi Portal Data
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- F1 TEAM RADIO QUOTE -->
                    <div class="ls-team-radio">
                        <div class="ls-radio-header">
                            <span>GRIDSTART TEAM RADIO</span>
                            <div class="ls-radio-dot"></div>
                        </div>
                        <div class="ls-radio-body">
                            <div class="ls-radio-wave">
                                <span></span><span></span><span></span><span></span><span></span>
                            </div>
                            <div>
                                <p class="ls-radio-text">
                                    "Make sure the braking is done in a straight line. Get the apex late, and squeeze the throttle gently on exit. Trust the physics."
                                </p>
                                <span class="ls-radio-author">— Driver Coach</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- NAVIGATION FOOTER -->
                <footer class="ls-nav">
                    <a href="/yellow-flag" class="ls-nav-btn">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right: 8px; transform: scaleX(-1);"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        Kembali ke Yellow Flag
                    </a>
                    <a href="/brake-zone" class="ls-nav-btn next-btn">
                        Lanjut ke Brake Zone
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </footer>

            </main>

            <!-- RIGHT COLUMN: STICKY HUD PANEL -->
            <aside class="ls-hud">
                <div class="ls-hud-header">
                    <span class="ls-hud-title">Race Control HUD</span>
                    <span class="ls-hud-status">Stage 3/6</span>
                </div>
                
                <!-- Track Progress Line inside HUD -->
                <div class="ls-hud-track">
                    <a href="/start-grid" class="ls-hud-node completed" data-label="Grid" title="Stage 1: Start Grid"></a>
                    <a href="/yellow-flag" class="ls-hud-node completed" data-label="Yellow" title="Stage 2: Yellow Flag"></a>
                    <a href="/racing-line" class="ls-hud-node active" data-label="Apex" title="Stage 3: Racing Line"></a>
                    <a href="/brake-zone" class="ls-hud-node" data-label="Brake" title="Stage 4: Brake Zone"></a>
                    <a href="/pit-stop" class="ls-hud-node" data-label="Pit" title="Stage 5: Pit Stop"></a>
                    <a href="/finish-line" class="ls-hud-node" data-label="Finish" title="Stage 6: Finish Line"></a>
                </div>

                <!-- Live Telemetry Bars -->
                <div class="ls-hud-telemetry">
                    <div class="ls-tel-row">
                        <div class="ls-tel-meta">
                            <span>Speed Rating</span>
                            <span class="ls-tel-val" id="tel-speed-val">0 km/h</span>
                        </div>
                        <div class="ls-tel-track">
                            <div class="ls-tel-fill" id="tel-speed-fill"></div>
                        </div>
                    </div>
                    <div class="ls-tel-row">
                        <div class="ls-tel-meta">
                            <span>Grip Level</span>
                            <span class="ls-tel-val" id="tel-grip-val">0%</span>
                        </div>
                        <div class="ls-tel-track">
                            <div class="ls-tel-fill" id="tel-grip-fill"></div>
                        </div>
                    </div>
                    <div class="ls-tel-row">
                        <div class="ls-tel-meta">
                            <span>Driver Vigilance</span>
                            <span class="ls-tel-val" id="tel-vigilance-val">0%</span>
                        </div>
                        <div class="ls-tel-track">
                            <div class="ls-tel-fill" id="tel-vigilance-fill"></div>
                        </div>
                    </div>
                </div>

                <div class="ls-hud-action">
                    <a href="/" class="ls-hud-btn">Abandon Session</a>
                </div>
            </aside>

        </div>
        
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animate HUD Telemetry Bars on Load
        setTimeout(() => {
            animateTelemetry('tel-speed', 80, 80, ' km/h');
            animateTelemetry('tel-grip', 95, 95, '%');
            animateTelemetry('tel-vigilance', 90, 90, '%');
        }, 300);

        function animateTelemetry(prefix, targetVal, targetFillPct, suffix) {
            const fillEl = document.getElementById(`${prefix}-fill`);
            const valEl = document.getElementById(`${prefix}-val`);
            if (fillEl) fillEl.style.width = `${targetFillPct}%`;
            
            let current = 0;
            const duration = 800; // ms
            const intervalTime = 16; // ~60fps
            const steps = duration / intervalTime;
            const increment = targetVal / steps;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= targetVal) {
                    current = targetVal;
                    clearInterval(timer);
                }
                if (valEl) valEl.textContent = Math.round(current) + suffix;
            }, intervalTime);
        }

        // Initialize SVG highlight for Step 1
        highlightStep(1, 25, 260, 'path-entry');
    });

    // RACING LINE INTERACTIVE APEX VISUALIZER
    function highlightStep(stepNum, carX, carY, pathId) {
        // Set all explorer buttons to inactive
        const btns = document.querySelectorAll('.ls-explorer-btn');
        btns.forEach(btn => btn.classList.remove('active'));
        
        // Activate current button
        const activeBtn = document.getElementById(`btn-step${stepNum}`);
        if (activeBtn) activeBtn.classList.add('active');
        
        // Move car node to coordinate
        const car = document.getElementById('car-node');
        if (car) {
            car.setAttribute('cx', carX);
            car.setAttribute('cy', carY);
        }

        // Reset path styling on the SVG
        const paths = ['path-entry', 'path-brake', 'path-apex', 'path-exit'];
        paths.forEach(pId => {
            const pathEl = document.getElementById(pId);
            if (pathEl) {
                pathEl.setAttribute('stroke', 'transparent');
            }
        });

        // Highlight selected path segment
        const highlightEl = document.getElementById(pathId);
        if (highlightEl) {
            highlightEl.setAttribute('stroke', '#3b82f6');
            highlightEl.setAttribute('stroke-width', '4');
            highlightEl.setAttribute('filter', 'drop-shadow(0 0 6px #3b82f6)');
        }
    }
</script>
@endsection