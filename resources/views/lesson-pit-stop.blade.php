@extends('app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
@endsection

@section('content')

<div class="ls-page-wrapper" data-stage="5">
    <div class="ls-container">
        
        <!-- MAIN PAGE GRID -->
        <div class="ls-grid">
            
            <!-- LEFT COLUMN: EDITORIAL CONTENT -->
            <main class="ls-main-content">
                
                <!-- HERO HEADER -->
                <header class="ls-hero">
                    <div class="ls-hero-watermark">05</div>
                    <div class="ls-hero-tag">Stage 5 • Pit Stop</div>
                    <h1>Pit Stop —<br>Berhenti Sejenak untuk Melaju Lebih Jauh</h1>
                    <p class="ls-hero-desc">
                        Di Formula 1, pit stop bukanlah tanda kelemahan, melainkan keputusan strategi yang krusial. 
                        Berhenti selama 2.5 detik untuk mengganti ban aus bisa menjadi penentu antara naik podium atau tersingkir. 
                        Di jalan raya, "pit stop" adalah seni mengelola stamina tubuh dan kesehatan mekanis kendaraan Anda.
                    </p>
                </header>

                <!-- SECTION 1: THE STRATEGY OF REST AND INSPECTION -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Mengelola Energi Pengemudi & Mesin</h2>
                    
                    <div class="ls-editorial-spread">
                        <div class="ls-editorial-panel">
                            <h3>Microsleep: Musuh yang Tidak Bersuara</h3>
                            <p>
                                Mengantuk saat berkendara memicu fenomena <em>microsleep</em>—keadaan hilangnya kesadaran secara mendadak selama 1 hingga 5 detik. Di kecepatan 80 km/jam, memejamkan mata selama 4 detik berarti kendaraan Anda meluncur sejauh 89 meter tanpa kendali lajur. Microsleep tidak bisa diperangi dengan meminum kopi atau mendengarkan musik keras; satu-satunya obat adalah berhenti dan tidur sejenak.
                            </p>
                        </div>
                        
                        <div class="ls-editorial-panel">
                            <h3>Pemeliharaan Preventif (F1 Standard)</h3>
                            <p>
                                Tim F1 mengganti suku cadang mobil *sebelum* komponen tersebut mengalami kerusakan, bukan sesudahnya. Mereka melakukan inspeksi ketat di paddock. Di jalan raya, merawat ban, mengecek rem, dan memeriksa oli secara terjadwal adalah garis pertahanan preventif Anda agar terhindar dari kerusakan fatal di tengah perjalanan.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- INTERACTIVE WIDGET: MAINTENANCE CHECKLIST & RADIAL GAUGE -->
                <section class="ls-widget-container">
                    <div class="ls-widget-header">
                        <h3>Interactive Pre-Trip Pit Checklist</h3>
                        <p>Lakukan pit stop virtual kendaraan Anda. Centang empat aspek krusial di bawah untuk mengukur tingkat kesiapan berkendara.</p>
                    </div>
                    
                    <div class="ls-checklist-widget">
                        <!-- Left: Interactive Checkboxes -->
                        <div class="ls-checklist-items">
                            <label class="ls-check-lbl">
                                <div class="ls-check-box-wrapper">
                                    <input type="checkbox" class="ls-check-input" id="chk-tyre" onchange="updateReadinessGauge()">
                                    <div class="ls-check-custom">
                                        <svg width="12" height="10" viewBox="0 0 14 11" fill="none"><path d="M1 5l4 4L13 1" stroke-width="3" stroke-linecap="round"/></svg>
                                    </div>
                                </div>
                                <div class="ls-check-text">
                                    <h4>Inspeksi Tekanan Ban</h4>
                                    <p>Ban kurang angin memicu handling liar dan memperpanjang jarak rem hingga 20%.</p>
                                </div>
                            </label>
                            
                            <label class="ls-check-lbl">
                                <div class="ls-check-box-wrapper">
                                    <input type="checkbox" class="ls-check-input" id="chk-fatigue" onchange="updateReadinessGauge()">
                                    <div class="ls-check-custom">
                                        <svg width="12" height="10" viewBox="0 0 14 11" fill="none"><path d="M1 5l4 4L13 1" stroke-width="3" stroke-linecap="round"/></svg>
                                    </div>
                                </div>
                                <div class="ls-check-text">
                                    <h4>Evaluasi Fisik (Bebas Microsleep)</h4>
                                    <p>Pastikan durasi tidur malam cukup (> 7 jam) dan tidak merasa lelah/mengantuk berat.</p>
                                </div>
                            </label>
                            
                            <label class="ls-check-lbl">
                                <div class="ls-check-box-wrapper">
                                    <input type="checkbox" class="ls-check-input" id="chk-fuel" onchange="updateReadinessGauge()">
                                    <div class="ls-check-custom">
                                        <svg width="12" height="10" viewBox="0 0 14 11" fill="none"><path d="M1 5l4 4L13 1" stroke-width="3" stroke-linecap="round"/></svg>
                                    </div>
                                </div>
                                <div class="ls-check-text">
                                    <h4>Ketersediaan Bahan Bakar</h4>
                                    <p>Jangan tunggu lampu indikator BBM menyala. Isi bahan bakar minimal di batas seperempat tangki.</p>
                                </div>
                            </label>
                            
                            <label class="ls-check-lbl">
                                <div class="ls-check-box-wrapper">
                                    <input type="checkbox" class="ls-check-input" id="chk-service" onchange="updateReadinessGauge()">
                                    <div class="ls-check-custom">
                                        <svg width="12" height="10" viewBox="0 0 14 11" fill="none"><path d="M1 5l4 4L13 1" stroke-width="3" stroke-linecap="round"/></svg>
                                    </div>
                                </div>
                                <div class="ls-check-text">
                                    <h4>Cek Servis Berkala & Cairan</h4>
                                    <p>Oli mesin, cairan radiator, dan minyak rem dipastikan terisi aman dan terawat rutin.</p>
                                </div>
                            </label>
                        </div>
                        
                        <!-- Right: Radial Gauge visualizer -->
                        <div class="ls-gauge-panel">
                            <div class="ls-gauge-svg">
                                <svg width="120" height="120">
                                    <circle class="ls-gauge-circle-bg" cx="60" cy="60" r="45"/>
                                    <circle class="ls-gauge-circle-fill" id="gauge-fill" cx="60" cy="60" r="45"/>
                                </svg>
                                <div class="ls-gauge-text" id="gauge-value">0%</div>
                            </div>
                            <span class="ls-gauge-lbl" id="gauge-status">System Standby</span>
                        </div>
                    </div>
                </section>

                <hr class="ls-divider">

                <!-- SECTION 2: MICROSLEEP FACTS AND RULES -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Data & Rekomendasi Keselamatan</h2>
                    
                    <div class="ls-ref-grid">
                        <div class="ls-ref-card" style="border-left: 4px solid #ef4444;">
                            <div>
                                <span class="ls-ref-tag">Statistik Nasional</span>
                                <h4>Fakta Microsleep di Indonesia</h4>
                                <p>Data Kementerian Perhubungan mencatat bahwa mengantuk dan microsleep menyumbang sekitar 30% dari total kecelakaan fatal di jalan tol nasional. Istirahat bukanlah membuang waktu perjalanan, melainkan strategi bertahan hidup.</p>
                            </div>
                            <a href="https://dephub.go.id" target="_blank" class="ls-ref-link">
                                Sumber: Kemenhub RI
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                        
                        <div class="ls-ref-card" style="border-left: 4px solid #8b5cf6;">
                            <div>
                                <span class="ls-ref-tag">Pedoman • WHO</span>
                                <h4>Aturan Pit Stop 2 Jam / 200 Km</h4>
                                <p>Badan Kesehatan Dunia (WHO) merekomendasikan pengendara untuk melakukan "pit stop" relaksasi minimal setiap 2 jam berkendara atau setiap melintasi jarak 200 kilometer guna merenggangkan otot dan memulihkan fokus saraf.</p>
                            </div>
                            <a href="https://www.who.int/roadsafety" target="_blank" class="ls-ref-link">
                                WHO Road Safety
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
                                    "Box, box! We are fitting a new set of tires and letting you catch your breath. The track condition is changing. Take your time."
                                </p>
                                <span class="ls-radio-author">— Team Strategist</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- NAVIGATION FOOTER -->
                <footer class="ls-nav">
                    <a href="/brake" class="ls-nav-btn">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right: 8px; transform: scaleX(-1);"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        Kembali ke Brake Zone
                    </a>
                    @auth
                    <a href="/simulasi" class="ls-nav-btn next-btn">
                        Lanjut ke Simulasi
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    @else
                    <a href="#" onclick="showLoginAlert(event)" class="ls-nav-btn next-btn">
                        Lanjut ke Simulasi
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    @endauth
                </footer>

            </main>

            <!-- RIGHT COLUMN: STICKY HUD PANEL -->
            <aside class="ls-hud">
                <div class="ls-hud-header">
                    <span class="ls-hud-title">Race Control HUD</span>
                    <span class="ls-hud-status">Stage 5/6</span>
                </div>
                
                <!-- Track Progress Line inside HUD -->
                <div class="ls-hud-track">
                    <a href="/start-grid" class="ls-hud-node completed" data-label="Grid" title="Stage 1: Start Grid"></a>
                    <a href="/yellow-flag" class="ls-hud-node completed" data-label="Yellow" title="Stage 2: Yellow Flag"></a>
                    <a href="/racing-line" class="ls-hud-node completed" data-label="Apex" title="Stage 3: Racing Line"></a>
                    <a href="/brake-zone" class="ls-hud-node completed" data-label="Brake" title="Stage 4: Brake Zone"></a>
                    <a href="/pit-stop" class="ls-hud-node active" data-label="Pit" title="Stage 5: Pit Stop"></a>
                    <a href="/finish-line" class="ls-hud-node" data-label="Finish" title="Stage 6: Finish Line"></a>
                </div>

                <!-- Live Telemetry Bars -->
                <div class="ls-hud-telemetry">
                    <div class="ls-tel-row">
                        <div class="ls-tel-meta">
                            <span>Driver Fatigue</span>
                            <span class="ls-tel-val" id="tel-speed-val">0%</span>
                        </div>
                        <div class="ls-tel-track">
                            <div class="ls-tel-fill" id="tel-speed-fill"></div>
                        </div>
                    </div>
                    <div class="ls-tel-row">
                        <div class="ls-tel-meta">
                            <span>Fuel Reserves</span>
                            <span class="ls-tel-val" id="tel-grip-val">0%</span>
                        </div>
                        <div class="ls-tel-track">
                            <div class="ls-tel-fill" id="tel-grip-fill"></div>
                        </div>
                    </div>
                    <div class="ls-tel-row">
                        <div class="ls-tel-meta">
                            <span>Vehicle Readiness</span>
                            <span class="ls-tel-val" id="tel-vigilance-val">0%</span>
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
    let checklistPercentage = 0;

    document.addEventListener('DOMContentLoaded', () => {
        // Animate HUD Telemetry Bars on Load
        setTimeout(() => {
            animateTelemetry('tel-speed', 15, 15, '%'); // Low fatigue
            animateTelemetry('tel-grip', 100, 100, '%'); // Full fuel
            animateTelemetry('tel-vigilance', 0, 0, '%'); // Tied to widget!
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
        
        // Init gauge
        updateReadinessGauge();
    });

    // INTERACTIVE PRE-TRIP CHECKLIST GAUGE
    function updateReadinessGauge() {
        const checkboxes = ['chk-tyre', 'chk-fatigue', 'chk-fuel', 'chk-service'];
        let checkedCount = 0;
        
        checkboxes.forEach(id => {
            if (document.getElementById(id).checked) {
                checkedCount++;
            }
        });
        
        const percentage = checkedCount * 25;
        
        // Update widget gauge
        const gaugeFill = document.getElementById('gauge-fill');
        const gaugeValue = document.getElementById('gauge-value');
        const gaugeStatus = document.getElementById('gauge-status');
        
        // 283 is the stroke-dasharray circumfrence for r=45
        const offset = 283 - (283 * percentage) / 100;
        
        if (gaugeFill) {
            gaugeFill.style.strokeDashoffset = offset;
        }
        if (gaugeValue) {
            gaugeValue.textContent = `${percentage}%`;
        }
        
        // Update widget label
        if (gaugeStatus) {
            if (percentage === 0) {
                gaugeStatus.innerHTML = '<span style="color:var(--color-muted);">System Standby</span>';
            } else if (percentage < 50) {
                gaugeStatus.innerHTML = '<span style="color:#ef4444; font-weight:700;">Mitigasi Awal</span>';
            } else if (percentage < 100) {
                gaugeStatus.innerHTML = '<span style="color:#f59e0b; font-weight:700;">Inspeksi Berlanjut</span>';
            } else {
                gaugeStatus.innerHTML = '<span style="color:#10b981; font-weight:900; animation: pulseGlow 1s infinite alternate;">READY TO LAUNCH</span>';
            }
        }

        // Connect widget value directly to HUD Telemetry "Vehicle Readiness" bar!
        const hudFill = document.getElementById('tel-vigilance-fill');
        const hudVal = document.getElementById('tel-vigilance-val');
        if (hudFill) {
            hudFill.style.width = `${percentage}%`;
        }
        if (hudVal) {
            hudVal.textContent = `${percentage}%`;
        }
    }

    function showLoginAlert(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Akses Terbatas',
            text: 'Untuk masuk ke simulasi berkendara, Anda wajib login terlebih dahulu.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8b5cf6', // Stage 5 purple accent color
            cancelButtonColor: '#3f3a36',
            confirmButtonText: 'Login Sekarang',
            cancelButtonText: 'Batal',
            background: '#f7f3ee',
            color: '#3f3a36'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    }
</script>
@endsection