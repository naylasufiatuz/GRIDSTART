@extends('app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
@endsection

@section('content')

<div class="ls-page-wrapper" data-stage="4">
    <div class="ls-container">
        
        <!-- MAIN PAGE GRID -->
        <div class="ls-grid">
            
            <!-- LEFT COLUMN: EDITORIAL CONTENT -->
            <main class="ls-main-content">
                
                <!-- HERO HEADER -->
                <header class="ls-hero">
                    <div class="ls-hero-watermark">04</div>
                    <div class="ls-hero-tag">Stage 4 • Brake Zone</div>
                    <h1>Brake Zone —<br>Rem Bukan Refleks, tapi Keputusan</h1>
                    <p class="ls-hero-desc">
                        Di Formula 1, brake zone adalah zona di mana pembalap menantang hukum fisika — memotong kecepatan 
                        dari 300 km/jam hingga 80 km/jam dalam hitungan detik. Di jalan raya, pengereman bukan soal refleks semata, 
                        melainkan keputusan strategis yang didasari atas perhitungan jarak, grip ban, dan visibilitas.
                    </p>
                </header>

                <!-- SECTION 1: THE MECHANICS OF STOPPING -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Hukum Fisika Tidak Mengenal Toleransi</h2>
                    
                    <div class="ls-editorial-spread">
                        <div class="ls-editorial-panel">
                            <h3>Batas Cengkeraman (Traction Limit)</h3>
                            <p>
                                Ketika Anda menekan pedal rem, gaya gesek antara kampas dan cakram rem menghentikan putaran roda. Namun, yang sebenarnya menghentikan gerak maju kendaraan adalah cengkeraman ban terhadap aspal. Begitu ban terkunci (locking) karena rem ditekan terlalu keras melampaui grip limit, kendaraan akan meluncur bebas tanpa bisa dikendalikan kemudi.
                            </p>
                        </div>
                        
                        <div class="ls-editorial-panel">
                            <h3>Waktu Reaksi (Reaction Time)</h3>
                            <p>
                                Dari saat mata mendeteksi bahaya (misal, lampu rem mobil depan menyala) hingga kaki Anda menyentuh pedal rem, ada jeda waktu reaksi rata-rata 1.0 detik. Di kecepatan 80 km/jam, kendaraan Anda sudah meluncur sejauh 22 meter bahkan <em>sebelum</em> rem mulai menjepit cakram. Jarak ini membengkak drastis saat Anda mengantuk atau bermain ponsel.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- INTERACTIVE WIDGET: DYNAMIC BRAKE CALCULATOR -->
                <section class="ls-widget-container">
                    <div class="ls-widget-header">
                        <h3>Dynamic Brake Distance Calculator</h3>
                        <p>Sesuaikan slider kecepatan dan toggle kondisi jalan untuk memvisualisasikan total jarak berhenti aman secara dinamis.</p>
                    </div>
                    
                    <div class="ls-brake-calc">
                        <!-- Controls Row -->
                        <div class="ls-calc-controls">
                            <!-- Speed Slider -->
                            <div class="ls-slider-group">
                                <div class="ls-slider-meta">
                                    <span>Kecepatan Berkendara</span>
                                    <span id="calc-speed-lbl">80 km/jam</span>
                                </div>
                                <input type="range" min="40" max="120" step="10" value="80" class="ls-calc-slider" id="calc-speed-input">
                            </div>
                            
                            <!-- Dry/Wet Toggle -->
                            <div class="ls-toggle-group">
                                <button class="ls-toggle-btn active" id="toggle-dry" onclick="setRoadCondition('dry')">Aspal Kering</button>
                                <button class="ls-toggle-btn" id="toggle-wet" onclick="setRoadCondition('wet')">Aspal Basah</button>
                            </div>
                        </div>
                        
                        <!-- Visual representation bars -->
                        <div class="ls-calc-visual">
                            <!-- Row 1: Reaction Distance -->
                            <div class="ls-visual-row">
                                <span class="ls-row-lbl">1. Jarak Reaksi (1s)</span>
                                <div class="ls-row-bar-bg">
                                    <div class="ls-row-bar-fill reaction" id="bar-reaction"></div>
                                </div>
                                <span class="ls-row-val" id="val-reaction">22.2 m</span>
                            </div>
                            
                            <!-- Row 2: Braking Distance -->
                            <div class="ls-visual-row">
                                <span class="ls-row-lbl">2. Jarak Pengereman</span>
                                <div class="ls-row-bar-bg">
                                    <div class="ls-row-bar-fill braking" id="bar-braking"></div>
                                </div>
                                <span class="ls-row-val" id="val-braking">32.0 m</span>
                            </div>
                            
                            <!-- Divider -->
                            <div style="height: 1px; background: var(--color-border); margin: 8px 0;"></div>
                            
                            <!-- Row 3: Total Distance -->
                            <div class="ls-visual-row" style="font-weight: 800;">
                                <span class="ls-row-lbl" style="color:var(--color-dark);">Total Jarak Berhenti</span>
                                <div></div>
                                <span class="ls-row-val" id="val-total" style="color:var(--stage-accent); font-size:1.1rem;">54.2 m</span>
                            </div>
                        </div>
                        
                        <!-- Feedback Alert -->
                        <div class="ls-game-result" id="calc-alert" style="font-size:13px; text-align:left; line-height:1.5;">
                            Di kecepatan 80 km/jam, Anda membutuhkan jarak sekitar 54 meter untuk berhenti total di aspal kering.
                        </div>
                    </div>
                </section>

                <hr class="ls-divider">

                <!-- SECTION 2: 3 DEADLY MISTAKES -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">3 Kesalahan Fatal Pengereman</h2>
                    
                    <div class="ls-ref-grid">
                        <div class="ls-ref-card" style="border-top: 3px solid #ef4444;">
                            <div>
                                <span class="ls-ref-tag" style="color:#ef4444; font-weight:800;">Kesalahan 01</span>
                                <h4>Rem Mendadak di Jalan Basah</h4>
                                <p>Ketika jalan diguyur hujan, koefisien gesek aspal turun hingga 50%. Menekan rem mendadak (panic braking) akan langsung mengunci roda, memicu selip aquaplaning di mana mobil meluncur di atas air tanpa grip.</p>
                            </div>
                            <span class="ls-ref-tag" style="margin-top: 10px;">Grip Level: ~30%</span>
                        </div>
                        
                        <div class="ls-ref-card" style="border-top: 3px solid #f59e0b;">
                            <div>
                                <span class="ls-ref-tag" style="color:#f59e0b; font-weight:800;">Kesalahan 02</span>
                                <h4>Pengereman di Dalam Tikungan</h4>
                                <p>Melakukan deselerasi keras saat setir sudah diputar membebani ban depan secara berlebih. Roda akan kehilangan kemampuan grip lateral, memicu mobil lurus meluncur keluar jalan (understeer) atau melintir (oversteer).</p>
                            </div>
                            <span class="ls-ref-tag" style="margin-top: 10px;">Mitigasi: Threshold Braking</span>
                        </div>
                        
                        <div class="ls-ref-card" style="border-top: 3px solid #3b82f6;">
                            <div>
                                <span class="ls-ref-tag" style="color:#3b82f6; font-weight:800;">Kesalahan 03</span>
                                <h4>Mengabaikan Aturan Jarak Aman</h4>
                                <p>Banyak pengendara menempel ketat bumper kendaraan di depannya (tailgating). Tanpa celah jarak 3 detik, Anda tidak akan memiliki ruang fisik untuk merespons jika kendaraan di depan berhenti mendadak.</p>
                            </div>
                            <span class="ls-ref-tag" style="margin-top: 10px;">Rule: Aturan 3 Detik</span>
                        </div>
                    </div>
                </section>

                <hr class="ls-divider">

                <!-- SECTION 3: MOTORSPORT BRAKING AND REFERENCE -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Motorsport Knowledge</h2>
                    
                    <div class="ls-takeaway-box">
                        <h4>Threshold & Trail Braking</h4>
                        <p>
                            Pembalap Formula 1 menggunakan teknik <strong>Threshold Braking</strong>—menekan pedal rem sekuat tenaga di awal lintasan lurus untuk memaksimalkan beban aerodinamis, kemudian melepaskannya secara bertahap saat kecepatan turun. Teknik ini menjaga ban tetap berada di ambang penguncian tanpa memicu ban slide. Di jalan raya, teknologi ABS (Anti-lock Braking System) melakukan prinsip ini secara elektronik untuk Anda.
                        </p>
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
                                    "Brake pressure 100% down to turn 1. Avoid locking the rears. Release the brake smoothly as you rotate the car."
                                </p>
                                <span class="ls-radio-author">— Race Engineer</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- NAVIGATION FOOTER -->
                <footer class="ls-nav">
                    <a href="/racing-line" class="ls-nav-btn">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right: 8px; transform: scaleX(-1);"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        Kembali ke Racing Line
                    </a>
                    <a href="/pit-stop" class="ls-nav-btn next-btn">
                        Lanjut ke Pit Stop
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </footer>

            </main>

            <!-- RIGHT COLUMN: STICKY HUD PANEL -->
            <aside class="ls-hud">
                <div class="ls-hud-header">
                    <span class="ls-hud-title">Race Control HUD</span>
                    <span class="ls-hud-status">Stage 4/6</span>
                </div>
                
                <!-- Track Progress Line inside HUD -->
                <div class="ls-hud-track">
                    <a href="/start-grid" class="ls-hud-node completed" data-label="Grid" title="Stage 1: Start Grid"></a>
                    <a href="/yellow-flag" class="ls-hud-node completed" data-label="Yellow" title="Stage 2: Yellow Flag"></a>
                    <a href="/racing-line" class="ls-hud-node completed" data-label="Apex" title="Stage 3: Racing Line"></a>
                    <a href="/brake-zone" class="ls-hud-node active" data-label="Brake" title="Stage 4: Brake Zone"></a>
                    <a href="/pit-stop" class="ls-hud-node" data-label="Pit" title="Stage 5: Pit Stop"></a>
                    <a href="/finish-line" class="ls-hud-node" data-label="Finish" title="Stage 6: Finish Line"></a>
                </div>

                <!-- Live Telemetry Bars -->
                <div class="ls-hud-telemetry">
                    <div class="ls-tel-row">
                        <div class="ls-tel-meta">
                            <span>Brake Pressure</span>
                            <span class="ls-tel-val" id="tel-speed-val">0%</span>
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
                            <span>Speed Rating</span>
                            <span class="ls-tel-val" id="tel-vigilance-val">0 km/h</span>
                        </div>
                        <div class="ls-tel-track">
                            <div class="ls-tel-fill" id="tel-vigilance-fill"></div>
                        </div>
                    </div>
                </div>


            </aside>

        </div>
        
    </div>
</div>

@endsection

@section('scripts')
<script>
    let currentRoadCondition = 'dry';
    const speedInput = document.getElementById('calc-speed-input');

    document.addEventListener('DOMContentLoaded', () => {
        // Animate HUD Telemetry Bars on Load (Emergency Braking simulation: high brake, low grip, speed drops)
        setTimeout(() => {
            animateTelemetry('tel-speed', 100, 100, '%');
            animateTelemetry('tel-grip', 60, 60, '%');
            animateTelemetry('tel-vigilance', 100, 100, ' km/h');
            
            // Decelerating telemetry visual cue
            setTimeout(() => {
                const speedVal = document.getElementById('tel-vigilance-val');
                const speedFill = document.getElementById('tel-vigilance-fill');
                if (speedFill) speedFill.style.width = '0%';
                if (speedVal) speedVal.textContent = '0 km/h';
            }, 1200);
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

        // Initialize Brake Calculator Calculations
        calculateDistance();

        // Bind slider input
        speedInput.addEventListener('input', calculateDistance);
    });

    // DYNAMIC BRAKE ZONE CALCULATIONS
    function setRoadCondition(condition) {
        currentRoadCondition = condition;
        
        const dryBtn = document.getElementById('toggle-dry');
        const wetBtn = document.getElementById('toggle-wet');
        
        if (condition === 'dry') {
            dryBtn.classList.add('active');
            wetBtn.classList.remove('active');
        } else {
            wetBtn.classList.add('active');
            dryBtn.classList.remove('active');
        }
        
        calculateDistance();
    }

    function calculateDistance() {
        const speed = parseInt(speedInput.value);
        document.getElementById('calc-speed-lbl').textContent = `${speed} km/jam`;
        
        // 1. Reaction Distance (1 second constant) = speed in m/s * 1s
        const reactionDist = speed * 0.2778 * 1.0;
        
        // 2. Braking Distance = (v^2) / (2 * g * mu)
        // Kering mu = 0.7, Basah mu = 0.38
        const mu = (currentRoadCondition === 'dry') ? 0.7 : 0.35;
        const g = 9.81;
        const speedMps = speed * 0.2778;
        const brakingDist = (speedMps * speedMps) / (2 * g * mu);
        
        const totalDist = reactionDist + brakingDist;
        
        // Update texts
        document.getElementById('val-reaction').textContent = `${reactionDist.toFixed(1)} m`;
        document.getElementById('val-braking').textContent = `${brakingDist.toFixed(1)} m`;
        document.getElementById('val-total').textContent = `${totalDist.toFixed(1)} m`;
        
        // Scale bars (relative to max 200m scale for visualization)
        const scaleMax = 180; // meters max width scale
        const reactPct = Math.min(100, (reactionDist / scaleMax) * 100);
        const brakePct = Math.min(100, (brakingDist / scaleMax) * 100);
        
        document.getElementById('bar-reaction').style.width = `${reactPct}%`;
        document.getElementById('bar-braking').style.width = `${brakePct}%`;
        
        // Generate contextual F1 warning alert
        const alertBox = document.getElementById('calc-alert');
        let alertHTML = '';
        if (currentRoadCondition === 'dry') {
            alertHTML = `Di lajur kering pada kecepatan <strong>${speed} km/jam</strong>, Anda membutuhkan total <strong>${totalDist.toFixed(1)} meter</strong> lapang untuk berhenti total. Rem bekerja efisien dibantu koefisien traksi ban.`;
        } else {
            alertHTML = `⚠️ <strong>Peringatan Jalan Basah!</strong> Di kecepatan <strong>${speed} km/jam</strong>, total jarak berhenti membengkak menjadi <strong>${totalDist.toFixed(1)} meter</strong> (+${(brakingDist - (brakingDist / 2)).toFixed(0)}m lebih panjang dari aspal kering). Ban sangat mudah mengunci (lock-up) tanpa rem ABS.`;
        }
        alertBox.innerHTML = alertHTML;
    }
</script>
@endsection