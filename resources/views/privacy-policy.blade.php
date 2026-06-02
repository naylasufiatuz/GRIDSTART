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
    <h1>Kebijakan Privasi</h1>
    <p>Terakhir diperbarui: 2 Juni 2026</p>
  </div>

  <div class="legal-section">
    <h2>1. Pendahuluan</h2>
    <p>Selamat datang di platform edukasi berkendara interaktif GridStart. Kami berkomitmen untuk menghormati dan melindungi privasi serta keamanan informasi pribadi setiap pengguna. Kebijakan Privasi ini menjelaskan bagaimana data Anda kami kumpulkan, kelola, simpan, dan ungkapkan saat Anda berinteraksi dengan layanan kami.</p>
  </div>

  <div class="legal-section">
    <h2>2. Informasi yang Kami Kumpulkan</h2>
    <p>Kami mengumpulkan beberapa jenis informasi untuk memberikan dan meningkatkan layanan kami:</p>
    <ul class="legal-list">
      <li><strong>Data Profil Autentikasi:</strong> Nama pengguna, kata sandi terenkripsi, serta alamat email yang Anda berikan saat registrasi.</li>
      <li><strong>Data Aktivitas Pengguna:</strong> Data penggunaan fitur, preferensi, dan interaksi Anda di dalam platform.</li>
      <li><strong>Data Perangkat:</strong> Jenis peramban web, resolusi layar, dan sistem operasi yang Anda gunakan.</li>
    </ul>
  </div>

  <div class="legal-section">
    <h2>3. Cara Penggunaan Data</h2>
    <p>Informasi yang kami kumpulkan digunakan untuk tujuan berikut:</p>
    <ul class="legal-list">
      <li>Mengelola akses dan keamanan akun Anda di platform.</li>
      <li>Menganalisis performa platform dan memperbaiki masalah teknis.</li>
      <li>Menyediakan layanan yang lebih personal dan relevan dengan kebutuhan Anda.</li>
      <li>Menjaga keamanan sistem dari penyalahgunaan atau aktivitas mencurigakan.</li>
    </ul>
  </div>

  <div class="legal-section">
    <h2>4. Penyimpanan dan Keamanan Data</h2>
    <p>Kami mengambil langkah-langkah keamanan untuk melindungi data Anda. Transmisi data dilakukan menggunakan protokol HTTPS yang dienkripsi. Kata sandi akun Anda disimpan dalam format hashing yang tidak dapat dibaca secara langsung.</p>
  </div>

  <div class="legal-section">
    <h2>5. Penggunaan Pihak Ketiga</h2>
    <p>Kami bekerja sama dengan penyedia layanan pihak ketiga seperti penyedia hosting cloud dan layanan pengiriman konten (CDN) untuk menjalankan platform ini. Pihak ketiga ini hanya memproses data Anda sesuai dengan instruksi kami dan terikat oleh kewajiban kerahasiaan.</p>
  </div>

  <div class="legal-section">
    <h2>6. Hak Pengguna</h2>
    <p>Anda berhak untuk mengakses, memperbarui, atau meminta penghapusan informasi pribadi Anda. Anda dapat melakukan perubahan langsung melalui pengaturan profil atau menghubungi kami jika membutuhkan bantuan lebih lanjut.</p>
  </div>

  <div class="legal-section">
    <h2>7. Kebijakan Anak di Bawah Umur</h2>
    <p>Layanan kami tidak ditujukan untuk anak-anak di bawah usia 13 tahun tanpa persetujuan orang tua. Jika kami mengetahui adanya pengumpulan data anak di bawah usia tersebut tanpa izin yang sah, kami akan segera menghapus data tersebut dari sistem kami.</p>
  </div>

  <div class="legal-section">
    <h2>8. Perubahan Kebijakan</h2>
    <p>Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Setiap perubahan akan diterbitkan di halaman ini dengan memperbarui tanggal "Terakhir diperbarui" di bagian atas dokumen.</p>
  </div>

  <div class="legal-section">
    <h2>9. Informasi Kontak</h2>
    <p>Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini, silakan hubungi kami melalui <a href="/contact" class="legal-link">halaman kontak</a> atau kirimkan email ke support@gridstart.id.</p>
  </div>
</div>

@endsection
