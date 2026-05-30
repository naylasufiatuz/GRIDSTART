@extends('app')

@section('content')

<section class="brake-section">
    <div class="container">

        <!-- HEADER -->
        <div class="header-section" style="margin-bottom:40px;">
            <p class="stage">STAGE 4 · BRAKE ZONE</p>
            <h1 class="title">Brake Zone —<br>Rem Bukan Refleks,<br>tapi Keputusan</h1>
            <p class="desc">
                Di F1, brake zone adalah titik pengereman yang dihitung presisi — terlalu awal buang waktu,
                terlalu telat masuk gravel. Di jalan raya, kita tidak punya data telemetri,
                tapi kita punya <strong>pemahaman</strong>. Dan itu sudah cukup untuk selamat.
            </p>
        </div>

        <!-- DIVIDER -->
        <div class="track-divider"><div class="dashed-line"></div></div>

        <!-- ILUSTRASI SVG -->
        <div class="brake-visual-box">
            <span class="visual-label">ILUSTRASI · BRAKE ZONE</span>
            <svg viewBox="0 0 860 180" xmlns="http://www.w3.org/2000/svg">
                <rect x="0" y="70" width="860" height="60" rx="4" fill="#d9d9d9"/>
                <line x1="0" y1="100" x2="860" y2="100" stroke="white" stroke-width="2" stroke-dasharray="20,14"/>
                <rect x="0"   y="70" width="240" height="60" fill="#4caf50" opacity="0.25"/>
                <text x="120" y="106" text-anchor="middle" font-size="11" fill="#2e7d32" font-weight="600" font-family="Inter,sans-serif">FULL SPEED</text>
                <rect x="240" y="70" width="200" height="60" fill="#ff9800" opacity="0.3"/>
                <text x="340" y="99"  text-anchor="middle" font-size="11" fill="#e65100" font-weight="700" font-family="Inter,sans-serif">⬛ BRAKE ZONE</text>
                <text x="340" y="114" text-anchor="middle" font-size="10" fill="#e65100" font-family="Inter,sans-serif">Angkat gas, injak rem bertahap</text>
                <rect x="440" y="70" width="140" height="60" fill="#2196f3" opacity="0.2"/>
                <text x="510" y="99"  text-anchor="middle" font-size="11" fill="#1565c0" font-weight="700" font-family="Inter,sans-serif">TURN IN</text>
                <text x="510" y="114" text-anchor="middle" font-size="10" fill="#1565c0" font-family="Inter,sans-serif">Setir halus, rem release</text>
                <rect x="580" y="70" width="100" height="60" fill="#9c27b0" opacity="0.2"/>
                <text x="630" y="99"  text-anchor="middle" font-size="11" fill="#6a1b9a" font-weight="700" font-family="Inter,sans-serif">APEX</text>
                <text x="630" y="114" text-anchor="middle" font-size="10" fill="#6a1b9a" font-family="Inter,sans-serif">Titik dalam tikungan</text>
                <rect x="680" y="70" width="180" height="60" fill="#4caf50" opacity="0.2"/>
                <text x="770" y="99"  text-anchor="middle" font-size="11" fill="#2e7d32" font-weight="700" font-family="Inter,sans-serif">EXIT</text>
                <text x="770" y="114" text-anchor="middle" font-size="10" fill="#2e7d32" font-family="Inter,sans-serif">Gas progresif keluar tikungan</text>
                <defs>
                    <marker id="arr" markerWidth="8" markerHeight="8" refX="6" refY="3" orient="auto">
                        <path d="M0,0 L0,6 L8,3 z" fill="#555"/>
                    </marker>
                </defs>
                <line x1="30" y1="50" x2="830" y2="50" stroke="#555" stroke-width="1.5" marker-end="url(#arr)" stroke-dasharray="4,3"/>
                <text x="30" y="44" font-size="10" fill="#888" font-family="Inter,sans-serif">Arah berkendara →</text>
            </svg>
        </div>

        <!-- KESALAHAN CARDS -->
        <h2 class="brake-mistakes-title">Yang Terjadi Kalau Kamu Rem di Waktu yang Salah</h2>
        <div class="brake-mistakes-grid">
            <div class="brake-mistake-card red">
                <span class="step-number">KESALAHAN 01</span>
                <h3>Rem Mendadak di Jalan Basah</h3>
                <p>Ban butuh jarak 2–3x lebih panjang di aspal basah. Rem mendadak = roda terkunci = selip tanpa kendali. <strong>Solusi:</strong> Pompa rem ritmis atau engine braking sebelum menginjak rem.</p>
            </div>
            <div class="brake-mistake-card amber">
                <span class="step-number">KESALAHAN 02</span>
                <h3>Rem di Dalam Tikungan</h3>
                <p>Saat membelok, ban sudah dipakai untuk steering. Rem keras di saat bersamaan = grip habis = kendaraan melebar atau ekor melayang. <strong>Rem harus selesai sebelum masuk tikungan.</strong></p>
            </div>
            <div class="brake-mistake-card blue">
                <span class="step-number">KESALAHAN 03</span>
                <h3>Tidak Menjaga Jarak Aman</h3>
                <p>Di 60 km/jam butuh 35 meter untuk berhenti. Di 80 km/jam, 60 meter. <strong>Aturan 3 detik:</strong> pilih titik tetap, kendaraan depan lewat → hitung 3 detik → baru kamu boleh melewatinya.</p>
            </div>
        </div>

        <!-- DIVIDER -->
        <div class="track-divider"><div class="dashed-line"></div></div>

        <!-- BOTTOM CARDS -->
        <div class="brake-bottom-grid">
            <div class="brake-info-card red">
                <p class="info-eyebrow">DATA · STOPPING DISTANCE</p>
                <h3>Berapa Meter Kamu Butuh untuk Berhenti?</h3>
                <div class="distance-rows">
                    <div class="distance-row">
                        <span class="speed-label">40 km/jam</span>
                        <div class="distance-bar green"></div>
                        <span class="dist-val">~15 m</span>
                    </div>
                    <div class="distance-row">
                        <span class="speed-label">60 km/jam</span>
                        <div class="distance-bar amber"></div>
                        <span class="dist-val">~35 m</span>
                    </div>
                    <div class="distance-row">
                        <span class="speed-label">80 km/jam</span>
                        <div class="distance-bar orange"></div>
                        <span class="dist-val">~60 m</span>
                    </div>
                    <div class="distance-row">
                        <span class="speed-label">100 km/jam</span>
                        <div class="distance-bar red"></div>
                        <span class="dist-val">~96 m</span>
                    </div>
                </div>
                <p class="distance-note">Jarak di atas sudah termasuk reaction time 1 detik. Di jalan basah, kalikan 1.5x.</p>
            </div>

            <div class="brake-info-card blue">
                <p class="info-eyebrow">REFERENSI · BELAJAR LEBIH</p>
                <h3>Teknik Pengereman yang Dipakai Pembalap F1</h3>
                <p>Trail braking, left-foot braking, threshold braking — semua ada penjelasannya di YouTube. Kontennya teknikal tapi disajikan visual, mudah dipahami meski kamu bukan mekanik.</p>
                <a href="https://www.youtube.com/results?search_query=f1+brake+zone+technique+explained"
                   target="_blank" class="brake-link-btn">
                    Cari di YouTube
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <!-- NAVIGATION -->
        <div class="lesson-nav">
            <a href="/racing-line" class="btn back">Kembali ke Racing Line</a>
            <a href="/pit-stop" class="btn next">Lanjut ke Pit Stop</a>
        </div>

    </div>
</section>

@endsection