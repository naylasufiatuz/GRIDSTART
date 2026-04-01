<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar ke GridStart</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/signon.css') }}"/>
</head>
<body>

<!-- LEFT -->
<div class="left-panel">
  <div class="form-card">
    <p class="badge">New Racer</p>
    <h1>Daftar ke GridStart</h1>
    <p>Bergabunglah dan pelajari keselamatan berkendara dengan pendekatan motorsport dari Start Grid hingga Finish Line.</p>

    @if(session('error'))
  <div class="alert alert-error">{{ session('error') }}</div>
@endif

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <form method="POST" action="{{ route('signon') }}">
      @csrf
      <div class="form-group">
        <label for="nama">User Name</label>
        <input type="text" id="nama" name="username" placeholder="Username" value="{{ old('username') }}"/>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Nama@gmail.com" value="{{ old('email') }}"/>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder=".........." minlength="5" required/>
      </div>
      <div class="form-group">
        <label for="konfirmasi">Konfirmasi Password</label>
        <input type="password" id="konfirmasi" name="password_confirmation" placeholder=".........." minlength="5" required/>
      </div>

      <button type="submit" class="btn-submit">Masuk ke Grid</button>
    </form>

    <p class="login-link">Sudah punya akun? <a href="/login">Login di sini</a></p>
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

</body>
</html>