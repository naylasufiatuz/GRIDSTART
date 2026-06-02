<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GridStart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/gridstart.css') }}">
    @yield('styles')
</head>

<body>

<!-- NAVBAR: kiri = menu | tengah = logo | kanan = CTA (seperti referensi) -->
<nav class="navbar" aria-label="Main navigation">
  <div class="navbar-inner">
    <div class="navbar-zone navbar-zone--links">
      <ul class="nav-menu">
        <li><a href="/">Roadmap</a></li>
        <li><a href="/simulasi">Simulasi</a></li>
        <li><a href="/leaderboard">Leaderboard</a></li>
        <li><a href="/contact">Contact</a></li>
      </ul>
    </div>

    <a href="/" class="navbar-brand" aria-label="GridStart — Home">
      <span class="navbar-brand__swap">
        <img src="{{ asset('images/GridStart_logo.png') }}" alt="" class="navbar-brand__mark" width="40" height="40" />
        <span class="navbar-brand__wordmark" aria-hidden="true">
          <span class="navbar-brand__grid">Grid</span><span class="navbar-brand__start">Start</span>
        </span>
      </span>
    </a>

    <div class="navbar-zone navbar-zone--actions">
      @guest
        <a href="/login" class="navbar-cta">Mulai Belajar</a>
      @endguest
      @auth
        <a href="/profile" class="navbar-cta">Profile</a>
      @endauth
    </div>
  </div>
</nav>

<!-- CONTENT MASUK SINI -->
@yield('content')

<!-- FOOTER -->
@include('components.footer')

<script>
  const reveals = document.querySelectorAll(
    ".reveal-left, .reveal-top, .reveal-item"
  );

  function revealOnScroll() {
    const windowHeight = window.innerHeight;

    reveals.forEach((el) => {
      const elementTop = el.getBoundingClientRect().top;

      if (elementTop < windowHeight - 80) {
        el.classList.add("show");
      }
    });
  }

  window.addEventListener("scroll", revealOnScroll);
  window.addEventListener("load", revealOnScroll);
</script>

<!-- LESSON YELLOW CONTENT -->
<script>
const reveal = document.querySelectorAll('.reveal-up');

function showOnScroll(){
const trigger = window.innerHeight - 80;

reveal.forEach(el=>{
const top = el.getBoundingClientRect().top;

if(top < trigger){
el.classList.add('show');
}
});
}

window.addEventListener('scroll',showOnScroll);
window.addEventListener('load',showOnScroll);
</script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: "{{ session('success') }}",
      confirmButtonColor: '#10b981'
    });
  </script>
@endif

@if(session('error'))
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Terjadi Kesalahan',
      text: "{{ session('error') }}",
      confirmButtonColor: '#ef4444'
    });
  </script>
@endif

@yield('scripts')

</body>
</html>