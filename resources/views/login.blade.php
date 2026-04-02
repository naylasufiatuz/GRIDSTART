
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - GridStart</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
</head>
<body>

<?php
$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  if (empty($username) || empty($password)) {
    $error = 'Username dan password wajib diisi.';
  } else {
    // TODO: cek ke database
    // Contoh: $user = User::where('username', $username)->first();
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
    <p class="badge">User Login</p>
    <h1>Mulai Belajar</h1>

    @if(session('error'))
  <div class="alert alert-error">{{ session('error') }}</div>
@endif

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"/>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="........"/>
      </div>

      <button type="submit" class="btn-submit">Masuk ke Grid</button>
    </form>

    <p class="register-link">Belum punya akun? <a href="/signon">Daftar di sini</a></p>
  </div>
</div>

</body>
</html>