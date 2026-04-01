@extends('app')

@section('content')

<section class="brake-section">
    <div class="container">

        <div class="left-content">
            <div class="header-section">
                <p class="stage">STAGE 4 . BRAKE ZONE</p>

                <h1 class="title">Brake Zone — Teknik Pengereman & Antisipasi Bahaya</h1>

                <p class="desc">
                    Brake Zone adalah zona pengereman adalah bagian dari lintasan balap
                    di mana pengemudi mobil mereka dengan menginjak rem sebelum
                    memasuki tikungan atau belokan.
                </p>
            </div>
        </div>

        <div class="right-content">

            <img src="{{ asset('images/brake-track.png') }}" class="track">

            <div class="label brake">Brake Zone</div>
            <div class="label turn">Turn In Point</div>
            <div class="label apex">Apex</div>

        </div>

    </div>

    <div class="lesson-nav">
        <a href="/racing-line" class="btn back">Kembali ke racing line</a>
        <a href="#" class="btn next">Lanjut ke Brake Zone</a>
    </div>

</section>

@endsection