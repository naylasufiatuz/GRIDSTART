@extends('app')

@section('content')

<section class="finish-line-section">
    <div class="finish-line-container">
        <div class="finish-line-content">
            <p class="stage">STAGE 7 . FINISH LINE</p>
            <h1 class="title">Finish Line — Selamat! <br>Kamu telah Berhasil <br>Menyelesaikan Perjalananmu</h1>
            <p class="desc">
                Kamu telah mencapai garis akhir perjalanan ini. Lihat skor akhir kamu dan<br>bagikan pencapaianmu dengan yang lain untuk menginspirasi lebih banyak orang.
            </p>

            <!-- BUTTONS -->
            <div class="finish-buttons">
                <a href="/" class="finish-btn back">Beranda</a>
                <a href="/leaderboard" class="finish-btn next">Lihat Leaderboard</a>
            </div>
        </div>
    </div>
</section>

@endsection
