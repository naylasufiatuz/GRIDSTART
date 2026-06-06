<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="robots" content="noindex, nofollow" />
  <title>Admin Access — GridStart</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}?v=1.1"/>
  <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}?v=1.1"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<!-- BACK BUTTON -->
<a href="/" class="back-button">
  <i class="fas fa-arrow-left"></i>
  <span>Kembali</span>
</a>

<!-- LEFT PANEL (BRANDING) -->
<div class="left-panel">
  <div class="left-content">
    <p class="brand-label">GridStart</p>
    <p class="brand-sub">Safety First &nbsp;·&nbsp; F1 Mindset</p>
    <h2>Admin Area Control</h2>
    <p>Akses terbatas untuk Administrator. Silakan masuk dengan kredensial terdaftar Anda untuk mengelola platform pembelajaran GridStart.</p>
  </div>
</div>

<!-- RIGHT PANEL (FORM) -->
<div class="right-panel">
  <div class="form-card">
    <!-- Security Badge -->
    <div class="security-badge">
      <i class="fas fa-shield-halved"></i>
      <span>Secure Admin Access</span>
    </div>

    <h1>Admin Panel</h1>

    @if(session('error'))
      <div class="alert alert-error">
        <i class="fas fa-circle-exclamation"></i>&nbsp; {{ session('error') }}
      </div>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Akses Ditolak',
          text: "{{ session('error') }}",
          confirmButtonColor: '#3f3a36'
        });
      </script>
    @endif

    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-circle-check"></i>&nbsp; {{ session('success') }}
      </div>
    @endif

    @if(session('lockout'))
      <div class="alert alert-warning">
        <i class="fas fa-clock"></i>&nbsp; {{ session('lockout') }}
      </div>
      <script>
        Swal.fire({
          icon: 'warning',
          title: 'Terlalu Banyak Percobaan',
          text: "{{ session('lockout') }}",
          confirmButtonColor: '#3f3a36'
        });
      </script>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}" id="adminLoginForm">
      @csrf

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Admin username" autocomplete="username" required value="{{ old('username') }}" />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="password-input-container">
          <input type="password" id="password" name="password" placeholder="••••••••" autocomplete="current-password" required />
          <i class="fas fa-eye" id="togglePassword"></i>
        </div>
      </div>

      <button type="submit" class="btn-submit" id="submitBtn">
        <i class="fas fa-right-to-bracket"></i>&nbsp; Masuk ke Dashboard
      </button>
    </form>

    <!-- Lockout Information -->
    <div class="lockout-info">
      <p>
        <i class="fas fa-shield-halved"></i>
        Akses ini dilindungi rate-limiting. Terlalu banyak percobaan login gagal akan mengunci akses sementara.
      </p>
    </div>
  </div>
</div>

<script>
  // Toggle password visibility
  document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      this.classList.remove('fa-eye');
      this.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      this.classList.remove('fa-eye-slash');
      this.classList.add('fa-eye');
    }
  });

  // Prevent double submit
  document.getElementById('adminLoginForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>&nbsp; Memverifikasi...';
    btn.style.opacity = '0.7';
  });
</script>

</body>
</html>
