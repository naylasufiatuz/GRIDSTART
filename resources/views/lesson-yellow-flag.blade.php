@extends('app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
@endsection

@section('content')

<div class="ls-page-wrapper" data-stage="2">
    <div class="ls-container">
        
        <!-- MAIN PAGE GRID -->
        <div class="ls-grid">
            
            <!-- LEFT COLUMN: EDITORIAL CONTENT -->
            <main class="ls-main-content">
                
                <!-- HERO HEADER -->
                <header class="ls-hero">
                    <div class="ls-hero-watermark">02</div>
                    <div class="ls-hero-tag">Stage 2 • Yellow Flag</div>
                    <h1>Yellow Flag —<br>Baca Situasi, Selamat Sampai Tujuan</h1>
                    <p class="ls-hero-desc">
                        Di Formula 1, bendera kuning bukan sekadar imbauan lambat — ini adalah instruksi taktis. 
                        Pembalap harus bersiap berhenti, menghindari puing-puing sirkuit, dan menjaga marshal. 
                        Di jalan raya, kemampuan "membaca situasi" adalah insting bertahan hidup yang paling krusial.
                    </p>
                </header>

                <!-- SECTION 1: THE DANGER OF IGNORING SIGNALS -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Kenapa Rambu & Marka Sering Diabaikan?</h2>
                    
                    <div class="ls-editorial-spread">
                        <div class="ls-editorial-panel">
                            <h3>Bias Risk Compensation</h3>
                            <p>
                                Banyak pengendara melanggar rambu bukan karena tidak tahu artinya, melainkan karena merasa situasinya aman. Ini adalah jebakan psikologis bernama <em>risk compensation</em>—ketika kita merasa memegang kendali penuh, kewaspadaan kita secara tidak sadar langsung menurun drastis. Rambu lalu lintas dipasang justru untuk mengantisipasi kondisi bahaya yang belum terlihat oleh mata Anda.
                            </p>
                        </div>
                        
                        <div class="ls-editorial-panel">
                            <h3>F1 Mindset: Antisipasi Total</h3>
                            <p>
                                Pembalap F1 melaju ratusan kilometer per jam karena mereka percaya bahwa marshal di sisi lintasan akan segera mengibarkan Yellow Flag begitu ada bahaya di depan. Di jalan raya, "marshal" Anda adalah kejelian mata Anda membaca marka jalan, rambu lalu lintas, dan pergerakan pengendara lain di sekitar.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- INTERACTIVE WIDGET: SITUATION DECISION BOARD -->
                <section class="ls-widget-container">
                    <div class="ls-widget-header">
                        <h3>Interactive Situation Decision Board</h3>
                        <p>Pilih situasi lalu lintas di bawah ini untuk melihat keputusan berkendara yang aman vs. fatal.</p>
                    </div>
                    
                    <div class="ls-decision-board">
                        <!-- Custom Tab Navigation -->
                        <div class="ls-tabs">
                            <button class="ls-tab-btn active" onclick="switchTab(event, 'tab-yellow')">Persimpangan</button>
                            <button class="ls-tab-btn" onclick="switchTab(event, 'tab-marking')">Marka Jalan</button>
                            <button class="ls-tab-btn" onclick="switchTab(event, 'tab-red')">Lampu Merah</button>
                        </div>
                        
                        <!-- TAB 1: PERSIMPANGAN -->
                        <div class="ls-tab-pane active" id="tab-yellow">
                            <div class="ls-decision-card incorrect">
                                <h4>
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 6px; color: #ef4444;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Keputusan Salah: Tancap Gas
                                </h4>
                                <p>Menambah kecepatan ketika melihat lampu kuning berkedip di persimpangan agar "keburu lewat". Tindakan ini sangat berisiko karena kendaraan dari arah silang berpotensi melakukan hal yang sama.</p>
                            </div>
                            <div class="ls-decision-card correct">
                                <h4>
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 6px; color: #10b981;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    Keputusan Benar: Siap Mengerem
                                </h4>
                                <p>Kurangi kecepatan secara signifikan, letakkan kaki di atas pedal rem (cover braking), pastikan tidak ada kendaraan lain dari arah kiri-kanan yang menyelonong masuk, lalu melintasi persimpangan dengan waspada.</p>
                            </div>
                        </div>
                        
                        <!-- TAB 2: MARKA JALAN -->
                        <div class="ls-tab-pane" id="tab-marking">
                            <div class="ls-decision-card incorrect">
                                <h4>
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 6px; color: #ef4444;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Keputusan Salah: Memotong Garis Penuh
                                </h4>
                                <p>Menyalip kendaraan atau berpindah jalur di marka garis putih penuh (solid), terutama di jalan menikung atau jembatan. Pelanggaran marka ini merupakan penyebab terbesar tabrakan adu banteng (head-on).</p>
                            </div>
                            <div class="ls-decision-card correct">
                                <h4>
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 6px; color: #10b981;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    Keputusan Benar: Sabar Menunggu Jalur
                                </h4>
                                <p>Tetap berada di lajur sendiri sepanjang marka berupa garis putih penuh. Anda hanya diperbolehkan menyalip atau mendahului kendaraan lain setelah marka berubah menjadi garis putus-putus dan situasi dipastikan aman.</p>
                            </div>
                        </div>
                        
                        <!-- TAB 3: LAMPU MERAH -->
                        <div class="ls-tab-pane" id="tab-red">
                            <div class="ls-decision-card incorrect">
                                <h4>
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 6px; color: #ef4444;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    Keputusan Salah: Menerobos Saat Sepi
                                </h4>
                                <p>Memaksa menerobos lampu merah dengan asumsi jalanan sedang sepi atau sunyi. Di F1, menerobos bendera merah berarti diskualifikasi instan. Di jalan raya, taruhannya adalah nyawa Anda dan orang lain.</p>
                            </div>
                            <div class="ls-decision-card correct">
                                <h4>
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 6px; color: #10b981;"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    Keputusan Benar: Berhenti Total
                                </h4>
                                <p>Berhenti sepenuhnya di belakang garis stop begitu lampu berganti merah. Gunakan jeda waktu ini untuk memulihkan kefokusan mata dan bersiap melaju kembali secara progresif saat lampu hijau menyala.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="ls-divider">

                <!-- SECTION 2: REAL ACCIDENT & DRIVER INCIDENTS -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Incident Analysis & Lessons</h2>
                    
                    <div class="ls-ref-grid">
                        <div class="ls-ref-card" style="border-left: 4px solid #ef4444;">
                            <div>
                                <span class="ls-ref-tag">Analisis Insiden Nyata</span>
                                <h4>Tragedi Tol Cipularang 11 Kendaraan</h4>
                                <p>Pada tahun 2023, kecelakaan beruntun masif terjadi di Tol Cipularang melibatkan 11 kendaraan. Penyebab utamanya adalah kegagalan pengemudi mengurangi kecepatan (abai Yellow Flag) saat menghadapi peringatan kabut tebal dan jalan licin.</p>
                            </div>
                            <span class="ls-ref-tag" style="margin-top: 10px; font-weight: 500;">Sumber: Korlantas Polri</span>
                        </div>
                        
                        <div class="ls-ref-card" style="border-left: 4px solid #f59e0b;">
                            <div>
                                <span class="ls-ref-tag">F1 vs Jalan Raya</span>
                                <h4>Lando Norris GP Belgia 2021</h4>
                                <p>Di Spa-Francorchamps yang diguyur hujan deras, Lando Norris tidak segera mengangkat gas (lift-off) saat double yellow flag berkibar, menyebabkannya kehilangan kendali di Eau Rouge. Di jalan raya, "marshal" yang Anda abaikan bisa berupa penyeberang jalan atau anak-anak.</p>
                            </div>
                            <span class="ls-ref-tag" style="margin-top: 10px; font-weight: 500;">Durasi Reaksi: < 1.0 Detik</span>
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
                                    "Yellow flag ahead, double yellow in sector 2. Lift off immediately, watch out for debris. No overtaking!"
                                </p>
                                <span class="ls-radio-author">— Pit Wall Control</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- NAVIGATION FOOTER -->
                <footer class="ls-nav">
                    <a href="/start-grid" class="ls-nav-btn">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right: 8px; transform: scaleX(-1);"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        Kembali ke Start Grid
                    </a>
                    <a href="/racing-line" class="ls-nav-btn next-btn">
                        Lanjut ke Racing Line
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </footer>

            </main>

            <!-- RIGHT COLUMN: STICKY HUD PANEL -->
            <aside class="ls-hud">
                <div class="ls-hud-header">
                    <span class="ls-hud-title">Race Control HUD</span>
                    <span class="ls-hud-status">Stage 2/6</span>
                </div>
                
                <!-- Track Progress Line inside HUD -->
                <div class="ls-hud-track">
                    <a href="/start-grid" class="ls-hud-node completed" data-label="Grid" title="Stage 1: Start Grid"></a>
                    <a href="/yellow-flag" class="ls-hud-node active" data-label="Yellow" title="Stage 2: Yellow Flag"></a>
                    <a href="/racing-line" class="ls-hud-node" data-label="Apex" title="Stage 3: Racing Line"></a>
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
            animateTelemetry('tel-speed', 40, 40, ' km/h');
            animateTelemetry('tel-grip', 80, 80, '%');
            animateTelemetry('tel-vigilance', 98, 98, '%');
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
    });

    // SITUATION DECISION TAB SWITCHING
    function switchTab(event, tabId) {
        // Remove active class from all buttons
        const tabBtns = document.querySelectorAll('.ls-tab-btn');
        tabBtns.forEach(btn => btn.classList.remove('active'));
        
        // Add active class to clicked button
        event.currentTarget.classList.add('active');
        
        // Hide all tab panes
        const tabPanes = document.querySelectorAll('.ls-tab-pane');
        tabPanes.forEach(pane => pane.classList.remove('active'));
        
        // Show selected tab pane
        const activePane = document.getElementById(tabId);
        if (activePane) activePane.classList.add('active');
    }
</script>
@endsection