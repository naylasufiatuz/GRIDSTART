@extends('app')

@section('content')

<!-- START GRID SECTION -->
<section class="start-grid-section">
    <div class="start-grid-container">
        <p class="roadmap-sub reveal-top">LEARNING TRACE • START GRID</p>
        <h1 class="lesson-title">Start Grid — Pengenalan Keselamatan Berkendara</h1>
        <p class="lesson-desc">Start Grid adalah titik awal sebelum balapan dimulai. Di tahap ini, pengendara harus siap secara mental, teknis, dan memahami prinsip dasar keselamatan berkendara.</p>

        <!-- Section for Safety Information -->
        <div class="safety-cards">
            <div class="safety-card">
                <h3>Apa itu Keselamatan Berkendara?</h3>
                <p>Keselamatan berkendara adalah upaya untuk meminimalkan risiko kecelakaan melalui perilaku berkendara yang sadar, bertanggung jawab, dan sesuai aturan.</p>
            </div>

            <div class="safety-card">
                <h3>Penyebab Umum Kecelakaan</h3>
                <p>Sebagian besar kecelakaan terjadi karena kelalaian manusia, seperti kurang fokus, kecepatan berlebih, tidak menjaga jarak, serta mengabaikan kondisi jalan dan kendaraan.</p>
            </div>

            <div class="safety-card">
                <h3>Konsep Safety First (F1 Mindset)</h3>
                <p>Dalam Formula 1, keselamatan adalah prioritas utama sebelum kecepatan. Prinsip ini diterapkan dengan persiapan matang, disiplin tinggi, dan pengambilan keputusan yang tepat di setiap situasi.</p>
            </div>
        </div>

        <!-- Navigation to the next stage (with back button) -->
        <div class="next-stage">
            <div class="lesson-nav">
                <a href="/" class="btn back">Kembali ke Roadmap</a>
                <a href="/yellow-flag" class="btn next">Lanjut ke Yellow Flag</a>
            </div>
        </div>
    </div>
</section>

@endsection
