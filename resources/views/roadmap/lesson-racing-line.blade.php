@extends('app')

@section('content')

<section class="racing-line-section">
    <div class="racing-line-container">
        <!-- HEADER -->
        <div class="header-section">
            <p class="stage">STAGE 3 . RACING LINE</p>
            <h1 class="title">Racing Line — Teknik Posisi & Kontrol Kendaraan</h1>
            <p class="desc">
                Racing Line adalah jalur optimal untuk melewati tikungan dengan aman, stabil, dan efisien. 
                Teknik ini melibatkan penguasaan posisi, kecepatan, dan kontrol kendaraan secara harmonis.
            </p>
        </div>

        <!-- DIVIDER -->
        <div class="track-divider">
            <div class="dashed-line"></div>
        </div>

        <!-- CARA BLABLABA SECTION -->
        <div class="steps-section">
            <h2 class="section-title">Cara blablaba</h2>
            <div class="steps-container">
                <div class="step-card">
                    <div class="step-number">STEP 1</div>
                    <h3>Arti Rambu Lalu Lintas</h3>
                    <p>Penjelasan tentang rambu lalu lintas dan fungsinya dalam memberikan informasi kepada pengendara di jalan.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">STEP 2</div>
                    <h3>Arti Rambu Lalu Lintas</h3>
                    <p>Penjelasan tentang rambu lalu lintas dan fungsinya dalam memberikan informasi kepada pengendara di jalan.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">STEP 3</div>
                    <h3>Arti Rambutan Lalu Lintas</h3>
                    <p>Penjelasan tentang rambu lalu lintas dan fungsinya dalam memberikan informasi kepada pengendara di jalan.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">STEP 4</div>
                    <h3>Arti Rambutan Lalu Lintas</h3>
                    <p>Penjelasan tentang rambu lalu lintas dan fungsinya dalam memberikan informasi kepada pengendara di jalan.</p>
                </div>
            </div>
        </div>

        <!-- DIVIDER -->
        <div class="track-divider">
            <div class="dashed-line"></div>
        </div>

        <!-- CONTOH SECTION -->
        <div class="example-section">
            <h2 class="section-title">Contoh</h2>
            <div class="example-container">
                <div class="example-box"></div>
                <div class="example-box"></div>
            </div>
        </div>

        <!-- NAVIGATION BUTTONS -->
        <div class="lesson-nav">
            <a href="/yellow-flag" class="btn back">Kembali ke Yellow Flag</a>
            <a href="/brake-zone" class="btn next">Lanjut ke Brake</a>
        </div>
    </div>
</section>

@endsection
