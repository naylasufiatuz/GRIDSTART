<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar ke GridStart</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <link rel="stylesheet" href="{{ asset('css/signon.css') }}"/>
</head>
<body>

<!-- BACK BUTTON -->
<a href="/" class="back-button">
  <i class="fas fa-arrow-left"></i>
  <span>Kembali</span>
</a>

<!-- LEFT -->
<div class="left-panel">
  <div class="left-container">
    <div class="form-card">
      <div class="form-header">
        <p class="badge">New Racer</p>
        <h1>Daftar ke GridStart</h1>
        <p class="form-description">Bergabunglah dan pelajari keselamatan berkendara dengan pendekatan motorsport dari Start Grid hingga Finish Line.</p>
      </div>

      @if(session('error'))
  <div class="alert alert-error">{{ session('error') }}</div>
@endif

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

      <form method="POST" action="{{ route('signon') }}">
        @csrf
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" id="nama" name="username" placeholder="Nama kamu" value="{{ old('username') }}"/>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Nama@gmail.com" value="{{ old('email') }}" required/>
        </div>
        <!-- Password -->
        <div class="form-group">
          <div class="password-input-container">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="........" required/>
            <i class="fas fa-eye toggle-icon"></i>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                  @if($errors->any())
                  <script>
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal Masuk Grid!',
                          text: '{{ $errors->first() }}', // Ini akan mengambil pesan dari controller
                          confirmButtonColor: '#e74c3c', // Bisa kamu sesuaikan dengan warna tombol/tema GridStart
                          confirmButtonText: 'Coba Lagi'
                      });
                  </script>
                  @endif
          </div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group">
          <div class="password-input-container">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="........" required/>
            <i class="fas fa-eye toggle-icon"></i>
          </div>
        </div>


        <button type="submit" class="btn-submit">Daftarkan Dirimu</button>
      </form>

      <!-- Divider -->
      <div class="divider">
        <span>atau daftar dengan Google</span>
      </div>

      <!-- Social Buttons -->
      <div class="social-buttons">
        <a href="{{ route('social.redirect', 'google') }}" class="btn-social btn-google">
          <i class="fab fa-google"></i>
          <span>Google</span>
        </a>
      </div>

      <p class="login-link">Sudah punya akun? <a href="/login">Login di sini</a></p>
    </div>
  </div>
</div>

<!-- RIGHT -->
<div class="right-panel">
  <div class="right-content">
    <p class="brand-label">GridStart</p>
    <p class="brand-sub">Safety First &nbsp;·&nbsp; F1 Mindset</p>
    <h2>Join The Grid</h2>
    <p>Setiap perjalanan yang aman selalu dimulai dengan persiapan yang benar. Di Start Grid, kamu akan belajar memahami keselamatan berkendara sebelum mulai melaju di jalan.</p>
  </div>
</div>

<script>
  document.querySelectorAll('.toggle-icon').forEach(function(icon) {
    icon.addEventListener('click', function() {
      var input = this.closest('.password-input-container').querySelector('input');
      if (input.type === 'password') {
        input.type = 'text';
        this.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        input.type = 'password';
        this.classList.replace('fa-eye-slash', 'fa-eye');
      }
    });
  });
</script>

</body>
</html>