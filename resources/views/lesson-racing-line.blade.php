@extends('app')

@section('content')

<section class="racing-line-section">
    <div class="racing-line-container">

        <!-- HEADER -->
        <div class="rl-header">
            <p class="stage">STAGE 3 · RACING LINE</p>
            <h1 class="title">Racing Line —<br>Jalur Terbaik Bukan yang Tercepat,<br>tapi yang Paling Aman</h1>
            <p class="desc">
                Di F1, racing line adalah jalur yang dihitung secara matematis untuk
                memaksimalkan kecepatan keluar tikungan. Di jalan raya, prinsipnya sama —
                bukan soal ngebut, tapi soal <strong>posisi yang tepat agar kamu selalu punya ruang bereaksi.</strong>
            </p>
        </div>

        <div class="track-divider"><div class="dashed-line"></div></div>

        <!-- STEP CARDS -->
        <h2 class="rl-steps-title">4 Prinsip Racing Line di Jalan Raya</h2>
        <div class="rl-steps-grid">
            <div class="rl-step-card">
                <span class="rl-step-number">STEP 1</span>
                <h3>Late Apex — Masuk Tikungan dari Luar</h3>
                <p>Jangan potong tikungan. Masuk dari jalur kiri sendiri, keluar tetap di kiri. Memotong tikungan = masuk jalur lawan = tabrakan head-on.</p>
            </div>
            <div class="rl-step-card">
                <span class="rl-step-number">STEP 2</span>
                <h3>Braking Point — Rem Sebelum Tikungan</h3>
                <p>Ngerem di dalam tikungan bikin ban kehilangan grip. Kurangi kecepatan <em>sebelum</em> tikungan, bukan saat sudah di dalamnya.</p>
            </div>
            <div class="rl-step-card">
                <span class="rl-step-number">STEP 3</span>
                <h3>Smooth Steering — Setir Harus Halus</h3>
                <p>Input setir yang kasar = transfer beban tiba-tiba = grip hilang. Putar setir secara progresif, jangan sentakan — apalagi di jalan basah atau berbatu.</p>
            </div>
            <div class="rl-step-card">
                <span class="rl-step-number">STEP 4</span>
                <h3>Exit Speed — Gas Keluar, Bukan Masuk</h3>
                <p>Akselerasi terbaik dimulai saat kendaraan sudah lurus. Nge-gas terlalu awal saat masih membelok bikin ban spin dan kendaraan liar ke bahu jalan.</p>
            </div>
        </div>

        <div class="track-divider"><div class="dashed-line"></div></div>

        <!-- BOTTOM CARDS -->
        <h2 class="rl-example-title">Pelajari Lebih Dalam</h2>
        <div class="rl-example-grid">
            <div class="rl-example-card amber">
                <p class="rl-eyebrow">REFERENSI · VIDEO</p>
                <h4>"The Physics of F1 Cornering" — Engineering Explained</h4>
                <p>Video paling clear soal kenapa racing line bukan soal keberanian tapi fisika — understeer, oversteer, weight transfer, dan grip. Setelah nonton ini kamu bakal otomatis lebih hati-hati di tikungan.</p>
                <a href="https://www.youtube.com/@EngineeringExplained" target="_blank" class="rl-link-btn">
                    Tonton di YouTube
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="rl-example-card red">
                <p class="rl-eyebrow">DATA · KECELAKAAN INDONESIA</p>
                <h4>72% Kecelakaan di Tikungan Terjadi Karena Posisi Jalur yang Salah</h4>
                <p>Data Korlantas Polri 2023 — mayoritas kecelakaan head-on di jalan nasional terjadi di tikungan, bukan karena kecepatan semata, tapi karena pengendara tidak menjaga posisi jalur yang benar.</p>
                <a href="https://korlantas.polri.go.id" target="_blank" class="rl-link-btn">
                    Lihat Data Korlantas
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <!-- NAVIGATION -->
        <div class="lesson-nav">
            <a href="/yellow-flag" class="btn back">Kembali ke Yellow Flag</a>
            <a href="/brake-zone" class="btn next">Lanjut ke Brake Zone</a>
        </div>

    </div>
</section>

@endsection