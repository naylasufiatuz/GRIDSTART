@extends('app')

@section('content')

<section class="yellow-section">

<div class="yellow-container">

    <!-- LEFT SIDE -->
    <div class="yellow-left reveal-up">

        <p class="stage">STAGE 2 . YELLOW FLAG</p>

        <h1 class="title">
            Yellow Flag — Rambu <br>
            & Marka Jalan
        </h1>

        <p class="desc">
            Yellow Flag menandakan kondisi yang membutuhkan kewaspadaan tinggi.
            Dalam berkendara sehari-hari, prinsip ini diterapkan melalui rambu,
            marka jalan, dan lampu lalu lintas.
        </p>

        <div class="info-box">

            <h3>Arti Rambu Lalu Lintas</h3>
            <p>
                Rambu lalu lintas berfungsi sebagai sistem komunikasi visual
                antara pengendara dan kondisi jalan. Memahami rambu berarti
                mampu mengantisipasi bahaya sebelum terjadi.
            </p>

            <h3>Arti Marka Lalu Lintas</h3>
            <p>
                Marka jalan memberi panduan jalur berkendara yang aman
                serta membantu pengendara menjaga posisi kendaraan.
            </p>

            <div class="flag-cards">

                <div class="flag yellow-flag">
                    <span class="dot"></span>
                    <h4>YELLOW FLAG</h4>
                    <p>Artinya: HATI-HATI<br>
                    Kurangi kecepatan dan tingkatkan fokus</p>
                </div>

                <div class="flag red-flag">
                    <span class="dot"></span>
                    <h4>RED FLAG</h4>
                    <p>Artinya: BERHENTI<br>
                    Wajib berhenti demi keselamatan</p>
                </div>

            </div>

        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="yellow-right reveal-up">

        <div class="side-card">
            <p>STAGE 2 . YELLOW FLAG</p>
        </div>

        <div class="side-card">
            <p>STAGE 2 . YELLOW FLAG</p>
        </div>

    </div>

</div>


<!-- BUTTON NAVIGATION -->
<div class="lesson-nav">
    <a href="/start-grid" class="btn back">Kembali ke Start Grid</a>
    <a href="/racing-line" class="btn next">Lanjut ke Racing Line</a>
</div>

</section>

@endsection