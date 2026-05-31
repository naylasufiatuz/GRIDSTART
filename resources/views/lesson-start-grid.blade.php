@extends('app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
@endsection

@section('content')

<div class="ls-page-wrapper" data-stage="1">
    <div class="ls-container">
        
        <!-- MAIN PAGE GRID -->
        <div class="ls-grid">
            
            <!-- LEFT COLUMN: EDITORIAL CONTENT -->
            <main class="ls-main-content">
                
                <!-- HERO HEADER -->
                <header class="ls-hero">
                    <div class="ls-hero-watermark">01</div>
                    <div class="ls-hero-tag">Stage 1 • Start Grid</div>
                    <h1>Start Grid —<br>Pengenalan Keselamatan Berkendara</h1>
                    <p class="ls-hero-desc">
                        Start Grid adalah titik awal sebelum bendera hijau dikibarkan. Di tahap ini, 
                        seorang pembalap tidak hanya memikirkan kecepatan, melainkan kesiapan mental, 
                        teknis, dan prinsip keselamatan yang kokoh.
                    </p>
                </header>

                <!-- SECTION 1: SAFETY FIRST CONCEPT -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">Keselamatan Bukan Batasan, Tapi Fondasi</h2>
                    
                    <div class="ls-editorial-spread">
                        <div class="ls-editorial-panel">
                            <h3>Apa itu Keselamatan Berkendara?</h3>
                            <p>
                                Keselamatan berkendara (Safety Riding) adalah upaya aktif untuk meminimalkan risiko kecelakaan melalui perilaku berkendara yang sadar, bertanggung jawab, dan patuh terhadap aturan. Ini adalah bentuk respek tertinggi terhadap diri sendiri dan pengguna jalan lain.
                            </p>
                        </div>
                        
                        <div class="ls-editorial-panel">
                            <h3>Penyebab Umum Kecelakaan</h3>
                            <p>
                                Sebagian besar kecelakaan di jalan raya disebabkan oleh kelalaian manusia (human error)—seperti kehilangan fokus, kecepatan berlebih yang tidak sesuai kondisi, abai menjaga jarak aman, serta meremehkan kesehatan fisik atau kondisi kelayakan kendaraan.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- INTERACTIVE GANTRY GAME WIDGET -->
                <section class="ls-widget-container">
                    <div class="ls-widget-header">
                        <h3>F1 Lights Out: Uji Waktu Reaksimu</h3>
                        <p>Di jalan raya, 1 milidetik keterlambatan merespons bisa berdampak fatal. Uji refleksmu di bawah ini!</p>
                    </div>
                    
                    <div class="ls-lights-game">
                        <!-- F1 Start Lights Gantry -->
                        <div class="ls-f1-gantry" id="gantry">
                            <div class="ls-light-column">
                                <div class="ls-light-dot"></div>
                                <div class="ls-light-dot"></div>
                            </div>
                            <div class="ls-light-column">
                                <div class="ls-light-dot"></div>
                                <div class="ls-light-dot"></div>
                            </div>
                            <div class="ls-light-column">
                                <div class="ls-light-dot"></div>
                                <div class="ls-light-dot"></div>
                            </div>
                            <div class="ls-light-column">
                                <div class="ls-light-dot"></div>
                                <div class="ls-light-dot"></div>
                            </div>
                            <div class="ls-light-column">
                                <div class="ls-light-dot"></div>
                                <div class="ls-light-dot"></div>
                            </div>
                        </div>

                        <!-- Buttons & Results -->
                        <div class="ls-game-controls">
                            <button class="ls-game-btn" id="start-btn">Start Lights Sequence</button>
                            <button class="ls-game-btn" id="action-btn" style="display:none;" disabled>BRAKE NOW!</button>
                        </div>
                        
                        <div class="ls-game-result" id="result-box">
                            Siap untuk membalap? Tekan tombol Start Sequence di atas.
                        </div>
                    </div>
                </section>

                <hr class="ls-divider">

                <!-- SECTION 2: F1 MINDSET -->
                <section class="ls-content-section">
                    <h2 class="ls-section-title">The Paddock Perspective</h2>
                    
                    <div class="ls-takeaway-box">
                        <h4>Konsep Safety First (F1 Mindset)</h4>
                        <p>
                            Dalam Formula 1, keselamatan adalah prioritas mutlak yang melahirkan inovasi ekstrem seperti struktur monocoque karbon dan sistem pelindung Halo. Prinsip ini mengajarkan bahwa kecepatan tinggi hanya bisa dieksplorasi secara aman jika persiapan teknis, mental disiplin, dan mitigasi risiko telah dihitung secara matang sebelum roda menggelinding di sirkuit.
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
                                    "No matter how fast you are in the corners, if you don't survive the first lap, you are not finishing. Preparation on the grid is everything."
                                </p>
                                <span class="ls-radio-author">— Race Engineer</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- NAVIGATION FOOTER -->
                <footer class="ls-nav">
                    <a href="/" class="ls-nav-btn">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right: 8px; transform: scaleX(-1);"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        Kembali ke Roadmap
                    </a>
                    <a href="/yellow-flag" class="ls-nav-btn next-btn">
                        Lanjut ke Yellow Flag
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </footer>

            </main>

            <!-- RIGHT COLUMN: STICKY HUD PANEL -->
            <aside class="ls-hud">
                <div class="ls-hud-header">
                    <span class="ls-hud-title">Race Control HUD</span>
                    <span class="ls-hud-status">Stage 1/6</span>
                </div>
                
                <!-- Track Progress Line inside HUD -->
                <div class="ls-hud-track">
                    <a href="/start-grid" class="ls-hud-node active" data-label="Grid" title="Stage 1: Start Grid"></a>
                    <a href="/yellow-flag" class="ls-hud-node" data-label="Yellow" title="Stage 2: Yellow Flag"></a>
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
            animateTelemetry('tel-speed', 0, 0, ' km/h');
            animateTelemetry('tel-grip', 100, 100, '%');
            animateTelemetry('tel-vigilance', 85, 85, '%');
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

        // F1 LIGHTS OUT GAME LOGIC
        const startBtn = document.getElementById('start-btn');
        const actionBtn = document.getElementById('action-btn');
        const resultBox = document.getElementById('result-box');
        const gantry = document.getElementById('gantry');
        const lights = gantry.querySelectorAll('.ls-light-dot');
        
        let startSequenceTime;
        let lightsOutTime;
        let gameTimer;
        let isWaitingForLightsOut = false;

        startBtn.addEventListener('click', () => {
            // Reset state
            lights.forEach(l => {
                l.classList.remove('red-on');
                l.classList.remove('green-on');
            });
            resultBox.innerHTML = '<span style="color:var(--color-muted);">Sistem gantry memuat... Tahan kemudi.</span>';
            startBtn.disabled = true;
            
            // Sequential lights lighting up
            let lightIndex = 0;
            const seqTimer = setInterval(() => {
                if (lightIndex < 5) {
                    // Turn on 2 red dots in current column
                    lights[lightIndex * 2].classList.add('red-on');
                    lights[lightIndex * 2 + 1].classList.add('red-on');
                    lightIndex++;
                } else {
                    clearInterval(seqTimer);
                    // Lights are fully on, wait random time for lights out
                    isWaitingForLightsOut = true;
                    startBtn.style.display = 'none';
                    actionBtn.style.display = 'inline-block';
                    actionBtn.disabled = false;
                    actionBtn.textContent = 'BRAKE / GO';
                    resultBox.innerHTML = '<span style="color:#ef4444; font-weight:800; animation: blink 0.5s infinite alternate;">WAIT FOR LIGHTS OUT...</span>';
                    
                    const randomDelay = 1000 + Math.random() * 2500;
                    gameTimer = setTimeout(() => {
                        // LIGHTS OUT!
                        lights.forEach(l => {
                            l.classList.remove('red-on');
                            l.classList.add('green-on'); // flash green
                        });
                        lightsOutTime = Date.now();
                        isWaitingForLightsOut = false;
                        resultBox.innerHTML = '<span style="color:#10b981; font-weight:900;">GO! GO! GO! INJAK REM!</span>';
                    }, randomDelay);
                }
            }, 450);
        });

        actionBtn.addEventListener('click', () => {
            if (isWaitingForLightsOut) {
                // Jump start! clicked too early
                clearTimeout(gameTimer);
                lights.forEach(l => l.classList.remove('red-on'));
                resultBox.innerHTML = '<span style="color:#ef4444; font-weight:900;">🚨 JUMP START! Kamu menekan rem terlalu awal! Jangan terburu-buru di jalan raya.</span>';
                resetGameUI();
            } else {
                // Legitimate click after lights out
                const reactionTimeMs = Date.now() - lightsOutTime;
                const reactionSec = (reactionTimeMs / 1000).toFixed(3);
                
                let comment = '';
                if (reactionTimeMs < 150) {
                    comment = '🚨 <strong>Waktu reaksi Elite (Lewis Hamilton level)!</strong> Refleks Anda sangat tajam.';
                } else if (reactionTimeMs <= 260) {
                    comment = '🏁 <strong>Pembalap Profesional!</strong> Refleks yang sangat baik, sigap menghindari bahaya.';
                } else if (reactionTimeMs <= 400) {
                    comment = '🚗 <strong>Rata-rata Pengemudi.</strong> Cukup aman, namun di jalan basah tetap harus waspada.';
                } else {
                    comment = '⚠️ <strong>Respon Lambat!</strong> Di kecepatan 80 km/jam, Anda akan meluncur 10+ meter sebelum rem bekerja. Istirahatlah jika lelah.';
                }
                
                resultBox.innerHTML = `Waktu reaksi Anda: <strong style="color:var(--stage-accent); font-size: 1.2rem;">${reactionSec}s</strong>.<br>${comment}`;
                resetGameUI();
            }
        });

        function resetGameUI() {
            actionBtn.disabled = true;
            setTimeout(() => {
                lights.forEach(l => {
                    l.classList.remove('red-on');
                    l.classList.remove('green-on');
                });
                actionBtn.style.display = 'none';
                startBtn.style.display = 'inline-block';
                startBtn.disabled = false;
            }, 4000);
        }
    });
</script>
<style>
    @keyframes blink {
        from { opacity: 0.5; }
        to { opacity: 1; }
    }
</style>
@endsection
