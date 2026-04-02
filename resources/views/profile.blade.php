<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile - GridStart</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}"/>
</head>
<body>

<?php
// Cek session login
if (!Auth::check()) {
    return redirect()->route('signon');
}
$user = Auth::user();
?>
<a href="/app">Back to App</a>
<!-- SIDEBAR -->
<div class="left-sidebar">
  <p class="brand-label">GridStart</p>
  <p class="brand-sub">Safety First · F1 Mindset</p>
</div>

<!-- MAIN -->
<div class="main-content">
  <div class="profile-card">
    <p class="badge">New Racer</p>
    <h1>Profile</h1>

    <!-- Avatar -->
    <div class="avatar-wrapper">
      <div class="avatar">
        <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="50" cy="38" r="20" fill="#1a1a1a"/>
          <ellipse cx="50" cy="85" rx="30" ry="20" fill="#1a1a1a"/>
        </svg>
      </div>
    </div>

    @if(session('error'))
      <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="username">Name</label>
        <input type="text" id="username" name="username" placeholder=".........." value="{{ Auth::user()->username }}"/>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder=".........."/>
      </div>

      <button type="submit" class="btn-submit">Edit Profile</button>
    </form>

    <p class="logout-link">
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    </p>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
      @csrf
    </form>
  </div>
</div>

</body>
</html>