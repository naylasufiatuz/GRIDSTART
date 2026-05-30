@extends('app')

@section('content')

<section class="pit-stop-section">
    <div class="pit-stop-container">

        <!-- HEADER -->
        <div class="pit-stop-header">
            <div class="rl-eyebrow-wrap">
                <div class="rl-eyebrow-line"></div>
                <p class="stage">STAGE 5 · PIT STOP</p>
            </div>
            <h1 class="title">Pit Stop —<br>Berhenti Sejenak untuk<br>Melaju Lebih Jauh</h1>
            <p class="desc">
                Di F1, pit stop bukan tanda kelemahan — ini keputusan strategis.
                Berhenti 2.5 detik untuk ganti ban bisa menentukan menang atau kalah.
                Di jalan raya, prinsipnya sama: tahu kapan harus berhenti,
                istirahat, dan cek kondisi sebelum lanjut.
            </p>
        </div>

        <div class="track-divider"><div class="dashed-line"></div></div>

        <!-- 4 CARDS -->
        <div class="pit-stop-carousel">
                <div class="carousel-item">
                    <div class="carousel-card ps-card">
                        <div class="ps-card-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/>
                                <path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.93 4.93l2.12 2.12M16.95 16.95l2.12 2.12M19.07 4.93l-2.12 2.12M7.05 16.95l-2.12 2.12"/>
                            </svg>
                        </div>
                        <h3>Cek Ban Sebelum Jalan</h3>
                        <p>Ban aus atau kurang angin = handling buruk + jarak rem lebih panjang. Cek tekanan ban minimal seminggu sekali dan sebelum perjalanan jauh. Tekanan ideal biasanya tertera di pintu pengemudi, bukan di ban.</p>
                        <span class="ps-tag">Sebelum Berangkat</span>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-card ps-card">
                        <div class="ps-card-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z"/>
                                <path d="M12 6v6l4 2"/>
                                <path d="M5 3L3 5M19 3l2 2"/>
                            </svg>
                        </div>
                        <h3>Microsleep — Pembunuh Diam-diam</h3>
                        <p>Mengantuk 4 detik di kecepatan 80 km/jam = kendaraan melaju 89 meter tanpa kendali. Jika sudah menguap terus, mata berat, atau kepala mengangguk — itu bukan tanda lelah biasa. <strong>Segera menepi dan istirahat.</strong></p>
                        <span class="ps-tag">Kondisi Pengemudi</span>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-card ps-card">
                        <div class="ps-card-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M3 22V10a2 2 0 0 1 2-2h3V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v12"/>
                                <path d="M9 22V12h6v10"/><path d="M12 7v1"/>
                            </svg>
                        </div>
                        <h3>Jangan Tunggu Lampu BBM Menyala</h3>
                        <p>Di F1, kehabisan bahan bakar = DNF instan. Di jalan raya, kehabisan bensin di tol atau jalan sepi bisa sangat berbahaya. Biasakan isi ulang saat indikator menyentuh seperempat tangki — bukan saat lampu sudah merah.</p>
                        <span class="ps-tag">Bahan Bakar</span>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="carousel-card ps-card">
                        <div class="ps-card-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                            </svg>
                        </div>
                        <h3>Servis Berkala = Nyawa Terjaga</h3>
                        <p>Tim F1 mengganti komponen sebelum rusak, bukan sesudah. Oli, rem, filter — semuanya dijadwal ketat. Di jalan raya, tunda servis = ambil risiko. Ikuti jadwal servis pabrikan, bukan tunggu sampai ada bunyi aneh.</p>
                        <span class="ps-tag">Perawatan Rutin</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="track-divider"><div class="dashed-line"></div></div>

        <!-- BOTTOM INFO -->
        <div class="ps-bottom-grid">

            <div class="ps-info-card ps-red">
                <p class="ps-eyebrow">FAKTA · MICROSLEEP</p>
                <h3>Mengantuk Menyebabkan 30% Kecelakaan Fatal di Indonesia</h3>
                <p>
                    Data Kementerian Perhubungan 2023 mencatat kantuk pengemudi sebagai
                    penyebab utama kecelakaan tunggal di jalan tol dan jalan nasional —
                    mengalahkan kecepatan berlebih dan melanggar rambu.
                    Istirahat bukan pilihan, tapi bagian dari strategi berkendara.
                </p>
                <a href="https://dephub.go.id" target="_blank" class="ps-link-btn">
                    Sumber: Kemenhub RI
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="ps-info-card ps-dark">
                <p class="ps-eyebrow">TIPS · PIT STOP STRATEGY</p>
                <h3>Aturan "Pit Stop" untuk Perjalanan Panjang</h3>
                <p>
                    Para ahli keselamatan berkendara merekomendasikan berhenti setiap
                    2 jam atau 200 km, mana yang lebih dulu tercapai.
                    Gunakan waktu berhenti untuk: peregangan kaki, minum air putih,
                    cek tekanan ban, dan pastikan tidak mengantuk sebelum lanjut.
                </p>
                <a href="https://www.who.int/roadsafety" target="_blank" class="ps-link-btn">
                    WHO Road Safety
                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>

        </div>

        <!-- NAVIGATION -->
        <div class="lesson-nav">
            <a href="/brake-zone" class="btn back">Kembali ke Brake Zone</a>
            <a href="/simulasi" class="btn next">Lanjut ke Simulasi</a>
        </div>

    </div>
</section>

@endsection