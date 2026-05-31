@extends('app')

@section('content')

<section class="yellow-section">

<div class="yellow-container">

    <!-- LEFT SIDE -->
    <div class="yellow-left reveal-up">

        <p class="stage">STAGE 2 · YELLOW FLAG</p>

        <h1 class="title">
            Yellow Flag —<br>
            Baca Situasi,<br>
            Selamat Sampai Tujuan
        </h1>

        <p class="desc">
            Di F1, yellow flag bukan sekadar "pelan-pelan" — ini perintah taktis.
            Pembalap wajib siap berhenti, menghindari debris, dan melindungi pembalap lain.
            Di jalan raya, prinsip yang sama berlaku setiap hari — tapi banyak yang mengabaikannya.
        </p>

        <div class="info-box">

            <h3>Kenapa Rambu & Marka Sering Diabaikan?</h3>
            <p>
                Bukan karena tidak tahu — tapi karena <strong>merasa situasinya aman</strong>.
                Ini yang disebut <em>risk compensation</em>: semakin percaya diri, semakin lengah.
                Padahal rambu dirancang justru untuk kondisi yang belum kamu antisipasi.
            </p>

            <h3 style="margin-top: 20px;">Baca Situasi Seperti Pembalap F1</h3>
            <p>Berikut situasi nyata di jalan dan cara baca yang benar:</p>

            <div class="flag-cards" style="flex-direction: column; gap: 14px; margin-top: 16px;">

                <div class="flag yellow-flag" style="border-radius: 5px; padding: 16px 20px;">
                    <h4>Lampu Kuning Berkedip di Persimpangan</h4>
                    <p style="margin-top: 6px; line-height: 1.6;">
                        <strong>Artinya:</strong> Tidak ada yang mengatur prioritas — semua harus ekstra hati-hati.<br>
                        <strong>Yang salah:</strong> Tancap gas karena "tidak ada yang merah".<br>
                        <strong>Yang benar:</strong> Kurangi kecepatan, pastikan kiri-kanan aman, baru lewat.
                    </p>
                </div>

                <div class="flag" style="border: 2px solid #a0c4a0; border-radius: 5px; padding: 16px 20px;">
                    <h4>Marka Garis Putus-Putus vs Garis Penuh</h4>
                    <p style="margin-top: 6px; line-height: 1.6;">
                        <strong>Garis putus-putus:</strong> Boleh pindah jalur jika aman.<br>
                        <strong>Garis penuh:</strong> Dilarang keras menyalip atau pindah jalur.<br>
                        <strong>Fakta:</strong> Pelanggaran marka garis penuh adalah penyebab utama tabrakan head-on di tikungan.
                    </p>
                </div>

                <div class="flag red-flag" style="border-radius: 5px; padding: 16px 20px;">
                    <h4>Lampu Merah — Bukan Pilihan</h4>
                    <p style="margin-top: 6px; line-height: 1.6;">
                        <strong>Yang salah:</strong> Terobos saat "kelihatannya sepi".<br>
                        <strong>Yang benar:</strong> Berhenti total sebelum garis, tunggu hijau.<br>
                        <strong>Ingat:</strong> Di F1, melewati red flag = diskualifikasi. Di jalan raya, taruhannya nyawa.
                    </p>
                </div>

            </div>

        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="yellow-right reveal-up">

        <div class="side-card" style="height: auto; padding: 24px; flex-direction: column; align-items: flex-start; gap: 12px; border-left: 4px solid #e6b34a; border-radius: 5px;">
            <p style="letter-spacing: 2px; font-size: 10px; color: #999; margin: 0;">STAGE 2 · YELLOW FLAG</p>
            <h4 style="font-size: 15px; font-weight: 700; color: #3f3a36; margin: 0;">Insiden Nyata: Abai Rambu</h4>
            <p style="font-size: 13px; line-height: 1.65; color: #5c5550; margin: 0;">
                Tahun 2023, sebuah kecelakaan beruntun di tol Cipularang melibatkan 11 kendaraan.
                Penyebab utama: pengendara tidak mengurangi kecepatan saat ada tanda peringatan
                jalan licin dan kabut tebal — sinyal "yellow flag" yang diabaikan.
            </p>
            <p style="font-size: 11px; color: #999; margin: 0;">Sumber: Korlantas Polri, 2023</p>
        </div>

        <div class="side-card" style="height: auto; padding: 24px; flex-direction: column; align-items: flex-start; gap: 12px; border-left: 4px solid #e34b3d; border-radius: 5px;">
            <p style="letter-spacing: 2px; font-size: 10px; color: #999; margin: 0;">STAGE 2 · YELLOW FLAG</p>
            <h4 style="font-size: 15px; font-weight: 700; color: #3f3a36; margin: 0;">F1 vs Jalan Raya</h4>
            <p style="font-size: 13px; line-height: 1.65; color: #5c5550; margin: 0;">
                Di GP Belgia 2021, Lando Norris tidak menepi saat yellow flag dan hampir
                menabrak marshal di lintasan. Di jalan raya, "marshal"-nya adalah pejalan kaki,
                pengendara motor, atau anak yang tiba-tiba menyeberang.
                Reaksi 1 detik bisa menentukan segalanya.
            </p>
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