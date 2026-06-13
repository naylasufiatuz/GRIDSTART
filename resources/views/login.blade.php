
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - GridStart</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<!-- BACK BUTTON -->
<a href="/" class="back-button">
  <i class="fas fa-arrow-left"></i>
  <span>Kembali</span>
</a>

<?php
$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  if (empty($username) || empty($password)) {
    $error = 'Username dan password wajib diisi.';
  } else {
    $success = 'Login berhasil! Selamat datang kembali.';
  }
}
?>

<!-- LEFT -->
<div class="left-panel">
  <div class="left-content">
    <p class="brand-label">GridStart</p>
    <p class="brand-sub">Safety First &nbsp;·&nbsp; F1 Mindset</p>
    <h2>Masuk ke Pit Lane</h2>
    <p>Sebelum memulai perjalanan dari Start Grid hingga Finish Line, pastikan kamu siap memahami keselamatan berkendara.</p>
  </div>
</div>

<!-- RIGHT -->
<div class="right-panel">
  <div class="form-card">
    <p class="badge">Driver Login</p>
    <h1>Masuk ke Cockpit</h1>

@if(session('error'))
  <div class="alert alert-error">{{ session('error') }}</div>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "{{ session('error') }}",
      confirmButtonColor: '#ff3b3b'
    });
  </script>
@endif

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: "{{ session('success') }}",
      confirmButtonColor: '#10b981'
    });
  </script>
@endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      @if(request('intended'))
        <input type="hidden" name="intended" value="{{ request('intended') }}">
      @endif
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required/>
      </div>
      <div class="form-group">
        <label for="password" required>Password</label>
        <div class="password-input-container">
          <input type="password" id="password" name="password" placeholder="........" required/>
          <i class="fas fa-eye" id="togglePassword"></i>
        </div>
      </div>

      <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
          } else {
            x.type = "password";
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
          }
        });
      </script>

      <button type="submit" class="btn-submit">Masuk ke Grid</button>
    </form>

    <!-- Divider -->
    <div class="divider">
      <span>atau masuk dengan Google</span>
    </div>

    <!-- Social Buttons -->
    <div class="social-buttons">
      <a href="{{ route('social.redirect', 'google') }}{{ request('intended') ? '?intended=' . request('intended') : '' }}" class="btn-social btn-google">
        <i class="fab fa-google"></i>
        <span>Google</span>
      </a>
    </div>
    
    <p class="register-link">Belum terdaftar sebagai driver? <a href="/signon{{ request('intended') ? '?intended=' . request('intended') : '' }}">Daftar di sini</a></p>
  </div>
</div>

</body>
</html>