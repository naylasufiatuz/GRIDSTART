@extends('app')

@section('content')

<style>
  .legal-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 140px 24px 80px;
    color: var(--taupe-dark);
  }

  .legal-header {
    margin-bottom: 40px;
    border-bottom: 1px solid rgba(63, 58, 54, 0.1);
    padding-bottom: 24px;
  }

  .legal-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 12px;
    color: var(--taupe-dark);
  }

  .legal-header p {
    font-size: 1rem;
    color: var(--taupe-soft);
  }

  .legal-section {
    margin-bottom: 40px;
  }

  .legal-section h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 16px;
    color: var(--taupe-dark);
  }

  .legal-section p, .legal-section li {
    font-size: 1rem;
    line-height: 1.8;
    color: var(--taupe-soft);
    margin-bottom: 16px;
  }

  .legal-list {
    padding-left: 20px;
    margin-bottom: 16px;
  }

  .legal-list li {
    margin-bottom: 8px;
  }

  .legal-link {
    color: var(--taupe-dark);
    font-weight: 600;
    text-decoration: underline;
  }

  .legal-link:hover {
    color: var(--accent-race);
  }
</style>

<div class="legal-container">
  <div class="legal-header">
    <h1>Syarat & Ketentuan</h1>
    <p>Terakhir diperbarui: 2 Juni 2026</p>
  </div>

  <div class="legal-section">
    <h2>1. Penerimaan Syarat Penggunaan</h2>
    <p>Dengan mengakses, menggunakan, atau mendaftarkan akun di platform edukasi GridStart, Anda menyatakan setuju untuk mematuhi dan terikat oleh Syarat & Ketentuan ini beserta seluruh kebijakan privasi terkait. Jika Anda tidak setuju dengan ketentuan ini, Anda dilarang menggunakan platform kami.</p>
  </div>

  <div class="legal-section">
    <h2>2. Hak dan Kewajiban Pengguna</h2>
    <p>Saat mendaftar akun di GridStart, Anda wajib:</p>
    <ul class="legal-list">
      <li>Memberikan informasi identitas yang akurat dan lengkap.</li>
      <li>Menjaga kerahasiaan kata sandi dan kredensial akun Anda.</li>
      <li>Bertanggung jawab penuh atas semua aktivitas yang terjadi menggunakan akun Anda.</li>
    </ul>
  </div>

  <div class="legal-section">
    <h2>3. Hak dan Kewajiban Platform</h2>
    <p>GridStart berhak sepenuhnya untuk:</p>
    <ul class="legal-list">
      <li>Memodifikasi, memperbarui, atau menghentikan sementara platform tanpa pemberitahuan jika diperlukan pemeliharaan teknis.</li>
      <li>Meninjau atau memvalidasi aktivitas pengguna pada platform.</li>
      <li>Menghapus konten pesan dari formulir kontak yang dianggap spam atau berbahaya.</li>
    </ul>
  </div>

  <div class="legal-section">
    <h2>4. Batasan Tanggung Jawab</h2>
    <p>Platform edukasi GridStart disediakan apa adanya. Kami <strong>tidak</strong> bertanggung jawab atas segala kerugian langsung maupun tidak langsung yang timbul akibat penggunaan atau ketidakmampuan menggunakan platform kami. Pengguna sepenuhnya bertanggung jawab atas risiko penggunaan layanan.</p>
  </div>

  <div class="legal-section">
    <h2>5. Larangan Penggunaan</h2>
    <p>Untuk memastikan lingkungan yang aman, Anda dilarang keras untuk:</p>
    <ul class="legal-list">
      <li>Memanipulasi atau meretas data dan sistem server kami.</li>
      <li>Mendekompilasi atau melakukan rekayasa balik (reverse engineering) pada perangkat lunak kami.</li>
      <li>Menggunakan program otomatis (bot) untuk mengeksploitasi sistem platform.</li>
    </ul>
  </div>

  <div class="legal-section">
    <h2>6. Hak Kekayaan Intelektual</h2>
    <p>Semua konten yang tersedia di GridStart, termasuk perangkat lunak, antarmuka visual, teks, grafik, dan merek dagang adalah milik sah dari tim GridStart dan dilindungi oleh undang-undang hak cipta Republik Indonesia. Tidak ada hak kepemilikan yang dialihkan kepada pengguna.</p>
  </div>

  <div class="legal-section">
    <h2>7. Penghentian Akses Akun</h2>
    <p>Kami memiliki hak untuk menangguhkan atau menghapus akun Anda sewaktu-waktu apabila Anda terbukti secara valid telah melanggar ketentuan yang tertuang di dalam dokumen ini, terutama pada bagian Larangan Penggunaan.</p>
  </div>

  <div class="legal-section">
    <h2>8. Perubahan Syarat Layanan</h2>
    <p>Syarat & Ketentuan ini dapat direvisi. Kami akan mempublikasikan pembaruan di halaman ini. Dengan terus melanjutkan penggunaan layanan kami setelah terjadinya perubahan, Anda secara otomatis menerima syarat yang baru tersebut.</p>
  </div>

  <div class="legal-section">
    <h2>9. Hukum yang Berlaku</h2>
    <p>Dokumen ini ditafsirkan dan diatur menurut hukum Republik Indonesia. Setiap perselisihan yang tidak dapat diselesaikan melalui musyawarah akan diselesaikan melalui yurisdiksi pengadilan di Jakarta Selatan, Indonesia.</p>
  </div>

  <div class="legal-section">
    <h2>10. Informasi Kontak</h2>
    <p>Pertanyaan, saran, atau pelaporan kendala mengenai Syarat & Ketentuan ini dapat Anda layangkan ke alamat email support@gridstart.id atau melalui <a href="/contact" class="legal-link">formulir kontak kami</a>.</p>
  </div>
</div>

@endsection
