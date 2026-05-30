@extends('app')

@section('content')

<section class="finish-line-section">

    <!-- CHECKERED PATTERN BACKGROUND -->
    <div class="fl-checkered"></div>

    <div class="finish-line-container">

        <!-- TOP BADGE -->
        <div class="fl-badge">
            <div class="fl-badge-icon">
                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <span>Race Complete</span>
        </div>

        <!-- MAIN CONTENT -->
        <div class="fl-main">
            <p class="fl-stage">STAGE 6 · FINISH LINE</p>

            <h1 class="fl-title">
                Kamu Sudah<br>
                <span class="fl-title-accent">Melewati</span><br>
                Garis Finish.
            </h1>

            <p class="fl-desc">
                Di F1, finish line bukan akhir — ini titik di mana data dikumpulkan,
                strategi dievaluasi, dan pembalap terbaik bersiap untuk race berikutnya.
                Kamu sudah belajar dari start grid sampai sini. Sekarang bawa pengetahuan
                itu ke jalanan yang nyata.
            </p>
        </div>

        <!-- STATS ROW -->
        <div class="fl-stats">
            <div class="fl-stat-item">
                <span class="fl-stat-num">6</span>
                <span class="fl-stat-label">Stage Diselesaikan</span>
            </div>
            <div class="fl-stat-divider"></div>
            <div class="fl-stat-item">
                <span class="fl-stat-num">F1</span>
                <span class="fl-stat-label">Mindset Acquired</span>
            </div>
            <div class="fl-stat-divider"></div>
            <div class="fl-stat-item">
                <span class="fl-stat-num">1</span>
                <span class="fl-stat-label">Nyawa yang Dijaga</span>
            </div>
        </div>

        <!-- QUOTE -->
        <div class="fl-quote">
            <div class="fl-quote-line"></div>
            <p class="fl-quote-text">
                "The best drivers know when to push and when to protect.
                Safety is not slow — it's precise."
            </p>
            <span class="fl-quote-attr">— Prinsip GridStart</span>
        </div>

        <!-- CHECKLIST -->
        <div class="fl-checklist">
            <div class="fl-check-item">
                <div class="fl-check-icon">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                </div>
                <span>Memahami prinsip keselamatan berkendara berbasis motorsport</span>
            </div>
            <div class="fl-check-item">
                <div class="fl-check-icon">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                </div>
                <span>Mengenal teknik pengereman, racing line, dan antisipasi bahaya</span>
            </div>
            <div class="fl-check-item">
                <div class="fl-check-icon">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                </div>
                <span>Siap menerapkan pit stop strategy dalam berkendara sehari-hari</span>
            </div>
        </div>

        <!-- BUTTONS -->
        <div class="fl-actions">
            <a href="/leaderboard" class="fl-btn fl-btn-primary">
                Lihat Skor Kamu
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="/" class="fl-btn fl-btn-ghost">
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection