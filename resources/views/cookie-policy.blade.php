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
    <h1>Kebijakan Cookie</h1>
    <p>Terakhir diperbarui: 2 Juni 2026</p>
  </div>

  <div class="legal-section">
    <h2>1. Apa Itu Cookies?</h2>
    <p>Cookies adalah file teks berukuran sangat kecil yang disimpan di perangkat Anda saat Anda mengunjungi situs web. Cookies digunakan agar situs dapat mengingat preferensi navigasi Anda, memastikan keamanan sesi login, serta meningkatkan pengalaman pengguna secara keseluruhan.</p>
  </div>

  <div class="legal-section">
    <h2>2. Jenis Cookies yang Kami Gunakan</h2>
    <p>Di platform GridStart, kami menggunakan kategori cookie berikut:</p>
    <ul class="legal-list">
      <li><strong>Cookie Esensial:</strong> Cookie yang wajib ada untuk fitur dasar platform, seperti keamanan (token CSRF) dan penyimpanan status login Anda.</li>
      <li><strong>Cookie Fungsional:</strong> Cookie yang menyimpan preferensi pengaturan Anda, misalnya preferensi bahasa atau antarmuka.</li>
      <li><strong>Cookie Analitik:</strong> Cookie untuk mengukur performa teknis seperti kecepatan memuat halaman dan stabilitas server.</li>
    </ul>
  </div>

  <div class="legal-section">
    <h2>3. Tujuan Penggunaan Cookies</h2>
    <p>Kami menggunakan cookie untuk mengoptimalkan pengalaman penggunaan platform Anda. Hal ini termasuk menjaga agar sesi Anda tetap berlanjut antar halaman, memfasilitasi penggunaan fitur, serta melakukan perbaikan teknis berdasarkan analisis penggunaan.</p>
  </div>

  <div class="legal-section">
    <h2>4. Cookies Pihak Ketiga</h2>
    <p>Beberapa fitur di platform kami mungkin mengandalkan layanan pihak ketiga, seperti autentikasi dan analitik. Layanan-layanan ini mungkin menyimpan cookie di perangkat Anda sesuai kebijakan privasi masing-masing.</p>
  </div>

  <div class="legal-section">
    <h2>5. Cara Mengelola atau Menonaktifkan Cookies</h2>
    <p>Anda memegang kendali penuh atas penggunaan cookie. Melalui pengaturan peramban (browser) web, Anda dapat:</p>
    <ul class="legal-list">
      <li>Menghapus cookie yang sudah ada di perangkat.</li>
      <li>Memblokir semua cookie pihak ketiga.</li>
      <li>Menerima peringatan sebelum cookie disimpan.</li>
    </ul>
    <p>Perlu diingat bahwa menonaktifkan Cookie Esensial dapat mengakibatkan beberapa fungsi penting GridStart, seperti sistem masuk akun, tidak dapat digunakan.</p>
  </div>

  <div class="legal-section">
    <h2>6. Perubahan Kebijakan Cookie</h2>
    <p>Kebijakan Cookie ini dapat diperbarui jika diperlukan. Semua perubahan akan langsung berlaku setelah dipublikasikan pada halaman ini beserta pembaruan tanggal di bagian atas dokumen.</p>
  </div>

  <div class="legal-section">
    <h2>7. Informasi Kontak</h2>
    <p>Apabila Anda memiliki pertanyaan lebih lanjut terkait penggunaan cookie di platform kami, silakan hubungi tim dukungan melalui <a href="/contact" class="legal-link">halaman kontak</a> atau email ke support@gridstart.id.</p>
  </div>
</div>

@endsection
