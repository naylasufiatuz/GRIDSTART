@extends('app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lesson.css') }}">
@endsection

@section('content')

<div class="ls-page-wrapper" data-stage="6">
    <!-- ELEGANT TOP CHECKERED ACCENT -->
    <div class="ls-hero-checkered" style="top: 0; bottom: auto; height: 24px;"></div>
    
    <div class="ls-container">
        
        <!-- CENTERED VICTORY LAYOUT -->
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            
            <!-- CELEBRATORY TAG -->
            <div class="ls-hero-tag" style="justify-content: center; margin-bottom: 24px;">
                Stage 6 • Finish Line
            </div>
            
            <h1 style="font-size: 46px; font-weight: 900; line-height: 1.15; color: var(--color-dark); margin-bottom: 20px; letter-spacing: -1px;">
                Selamat! Anda Telah<br>
                <span style="color: var(--stage-accent); background: linear-gradient(135deg, #d97706 0%, #fac755 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Melewati</span> Garis Finish.
            </h1>
            
            <p class="ls-hero-desc" style="margin: 0 auto 50px; font-size: 16px; max-width: 680px; text-align: center;">
                Di Formula 1, garis finish bukan sekadar akhir dari balapan — melainkan titik awal di mana data telemetri dikumpulkan, 
                performa dievaluasi, dan pembalap bersiap untuk sirkuit berikutnya. Anda telah menuntaskan seluruh trace keselamatan GridStart. 
                Kini saatnya membawa mentalitas F1 tersebut ke jalan raya nyata.
            </p>

            <!-- INTERACTIVE HOLOGRAPHIC LICENSE CARD -->
            <section class="ls-widget-container" style="background: transparent; border: none; box-shadow: none; padding: 0;">
                <div class="ls-widget-header">
                    <h3 style="color:var(--color-dark); font-size: 12px; font-weight: 800; letter-spacing: 1.5px;">Lisensi Berkendara Aman Digital</h3>
                    <p style="color:var(--color-muted);">Arahkan kursor atau sentuh kartu untuk memancarkan kilau hologram.</p>
                </div>
                
                <div class="ls-license-widget">
                    <div class="ls-license-card">
                        <!-- Card Header -->
                        <div class="ls-lic-header">
                            <div class="ls-lic-title">
                                <span>SAFETY LICENSE</span>
                                <span>GRIDSTART CHAMPIONSHIP</span>
                            </div>
                            <div class="ls-lic-chip"></div>
                        </div>
                        
                        <!-- Card Body -->
                        <div class="ls-lic-body">
                            <!-- Digital Circular Avatar -->
                            <div class="ls-lic-avatar" style="border-color: var(--stage-accent);">
                                @auth
                                    {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                                @else
                                    GS
                                @endauth
                            </div>
                            
                            <!-- Information fields -->
                            <div class="ls-lic-info" style="text-align: left;">
                                <div class="ls-lic-field">
                                    <label>Driver Username</label>
                                    <span>
                                        @auth
                                            {{ Auth::user()->username }}
                                        @else
                                            GUEST DRIVER
                                        @endauth
                                    </span>
                                </div>
                                <div class="ls-lic-field rank">
                                    <label>License Rank</label>
                                    <span style="color: #fac755;">S-CLASS SAFETY DRIVER</span>
                                </div>
                                <div class="ls-lic-field">
                                    <label>Graduation Date</label>
                                    <span>{{ date('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Paddock stamp overlay -->
                        <div class="ls-lic-stamp" style="border-color: var(--stage-accent);">
                            <span style="color: var(--stage-accent);">GRIDSTART</span>
                            <span style="color: var(--stage-accent); font-weight: 900; font-size: 6px;">GRADUATED</span>
                        </div>
                    </div>
                </div>
            </section>

            <hr class="ls-divider" style="margin: 40px 0;">

            <!-- STATS COUNTER GRID -->
            <section class="ls-content-section" style="margin-bottom: 40px;">
                <div class="ls-editorial-spread" style="grid-template-columns: repeat(3, 1fr); gap: 20px;">
                    <div class="ls-editorial-panel" style="border: none; border-right: 1px dashed var(--color-border); padding: 0;">
                        <span id="stat-stages" style="display: block; font-size: 42px; font-weight: 900; color: var(--color-dark); line-height: 1;">0</span>
                        <span style="font-size: 11px; font-weight: 800; letter-spacing: 1px; color: var(--color-muted); text-transform: uppercase; margin-top: 10px; display: block;">Stage Diselesaikan</span>
                    </div>
                    
                    <div class="ls-editorial-panel" style="border: none; border-right: 1px dashed var(--color-border); padding: 0;">
                        <span id="stat-mindset" style="display: block; font-size: 42px; font-weight: 900; color: var(--color-dark); line-height: 1; text-transform: uppercase;">0</span>
                        <span style="font-size: 11px; font-weight: 800; letter-spacing: 1px; color: var(--color-muted); text-transform: uppercase; margin-top: 10px; display: block;">Mindset Terpasang</span>
                    </div>
                    
                    <div class="ls-editorial-panel" style="border: none; padding: 0;">
                        <span id="stat-lives" style="display: block; font-size: 42px; font-weight: 900; color: var(--color-dark); line-height: 1;">0</span>
                        <span style="font-size: 11px; font-weight: 800; letter-spacing: 1px; color: var(--color-muted); text-transform: uppercase; margin-top: 10px; display: block;">Nyawa yang Dijaga</span>
                    </div>
                </div>
            </section>

            <!-- EDITORIAL CHECKLIST -->
            <section class="ls-content-section" style="margin-bottom: 50px; text-align: left; background: var(--bg-cream-soft); padding: 30px; border-radius: var(--border-radius-base); border: 1px solid var(--color-border);">
                <h3 style="font-size: 14px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; color: var(--color-dark); margin-bottom: 20px; text-align: center;">Kompetensi Kejuaraan Anda</h3>
                
                <div style="display: grid; gap: 16px; max-width: 600px; margin: 0 auto;">
                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div style="width: 20px; height: 20px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #10b981; margin-top: 2px;">
                            <svg width="10" height="8" viewBox="0 0 14 11" fill="none"><path d="M1 5l4 4L13 1" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                        </div>
                        <span style="font-size: 14px; color: var(--color-muted); line-height: 1.5;">Memahami prinsip dasar keselamatan berkendara berbasis kedisiplinan dan perhitungan risiko motorsport.</span>
                    </div>
                    
                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div style="width: 20px; height: 20px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #10b981; margin-top: 2px;">
                            <svg width="10" height="8" viewBox="0 0 14 11" fill="none"><path d="M1 5l4 4L13 1" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                        </div>
                        <span style="font-size: 14px; color: var(--color-muted); line-height: 1.5;">Mampu mengaplikasikan teknik pengereman ideal, pemosisian lajur sirkuit (racing line), serta antisipasi rambu lalu lintas secara taktis.</span>
                    </div>
                    
                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div style="width: 20px; height: 20px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #10b981; margin-top: 2px;">
                            <svg width="10" height="8" viewBox="0 0 14 11" fill="none"><path d="M1 5l4 4L13 1" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                        </div>
                        <span style="font-size: 14px; color: var(--color-muted); line-height: 1.5;">Siap menerapkan regulasi "pit stop" relaksasi tubuh secara periodik demi menghindari microsleep yang fatal.</span>
                    </div>
                </div>
            </section>

            <!-- GRADUATION TEAM RADIO QUOTE -->
            <div class="ls-team-radio" style="text-align: left; max-width: 680px; margin: 0 auto 50px;">
                <div class="ls-radio-header">
                    <span>GRIDSTART PIT WALL CONTROL</span>
                    <div class="ls-radio-dot"></div>
                </div>
                <div class="ls-radio-body">
                    <div class="ls-radio-wave">
                        <span></span><span></span><span></span><span></span><span></span>
                    </div>
                    <div>
                        <p class="ls-radio-text">
                            "Excellent drive, champion! The race is done, but the safety routine continues every single day. Bring this license home and drive with precision."
                        </p>
                        <span class="ls-radio-author">— Race Director</span>
                    </div>
                </div>
            </div>

            <!-- ACTION CTA BUTTONS -->
            <footer style="display: flex; justify-content: center; gap: 20px; margin-top: 40px; margin-bottom: 20px;">
                <a href="/leaderboard" class="ls-nav-btn next-btn" style="padding: 16px 36px; box-shadow: 0 4px 20px rgba(217, 119, 6, 0.35);">
                    Lihat Papan Skor
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-left: 8px;"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="/" class="ls-nav-btn" style="padding: 16px 36px;">
                    Kembali ke Beranda
                </a>
            </footer>

        </div>
    </div>
    
    <!-- ELEGANT BOTTOM CHECKERED ACCENT -->
    <div class="ls-hero-checkered" style="bottom: 0; top: auto; height: 24px;"></div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animate Victory Stats Counters
        setTimeout(() => {
            animateNumber('stat-stages', 6, 800, '');
            animateNumberText('stat-mindset', 'F1', 800);
            animateNumber('stat-lives', 1, 800, '+');
        }, 400);

        function animateNumber(id, target, duration, suffix) {
            const el = document.getElementById(id);
            if (!el) return;
            
            let current = 0;
            const intervalTime = 16;
            const steps = duration / intervalTime;
            const increment = target / steps;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                el.textContent = Math.round(current) + suffix;
            }, intervalTime);
        }

        function animateNumberText(id, text, duration) {
            const el = document.getElementById(id);
            if (!el) return;
            
            let current = 0;
            const timer = setInterval(() => {
                current += 1;
                if (current >= 10) {
                    el.textContent = text;
                    clearInterval(timer);
                } else {
                    el.textContent = Math.floor(Math.random() * 9);
                }
            }, duration / 10);
        }
    });
</script>
@endsection