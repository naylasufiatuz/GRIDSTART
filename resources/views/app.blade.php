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

<!-- GLOBAL LOADING SCREEN -->
<div id="site-loader" style="
  position:fixed;inset:0;z-index:99999;
  display:flex;flex-direction:column;justify-content:center;align-items:center;
  background:linear-gradient(98deg,#F2ECE5 57.47%,#D1DDD3 72.25%,#D1DDD3 87.02%,#DAE5EA 93.53%);
  transition:opacity .5s ease,visibility .5s;
">
  <div style="
    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:11px;font-weight:800;letter-spacing:3px;
    color:#6F6660;text-transform:uppercase;margin-bottom:14px;
    opacity:0;animation:ldFade .5s .1s forwards;
  ">LOADING</div>

  <div style="
    display:flex;align-items:center;gap:8px;margin-bottom:20px;
    opacity:0;animation:ldFade .5s .2s forwards;
  ">
    <img src="{{ asset('images/GridStart_logo.png') }}" alt="" style="width:44px;height:44px;object-fit:contain;border-radius:8px;" />
    <span style="font-family:'Space Mono',monospace;font-size:28px;font-weight:700;letter-spacing:2px;color:#3F3A36;">
      Grid<span style="color:#CBB89D;">Start</span>
    </span>
  </div>

  <!-- Animated racing stripe loader -->
  <div style="
    width:160px;height:3px;background:rgba(63,58,54,0.08);border-radius:2px;overflow:hidden;
    opacity:0;animation:ldFade .5s .3s forwards;
  ">
    <div style="
      height:100%;width:40%;border-radius:2px;
      background:linear-gradient(90deg,#CBB89D,#3F3A36);
      animation:ldSlide 1.2s ease-in-out infinite;
    "></div>
  </div>

  <style>
    @keyframes ldFade{0%{opacity:0;transform:translateY(6px)}100%{opacity:1;transform:translateY(0)}}
    @keyframes ldSlide{0%{transform:translateX(-100%)}50%{transform:translateX(250%)}100%{transform:translateX(-100%)}}
  </style>
</div>

<script>
  window.addEventListener('load',function(){
    var loader=document.getElementById('site-loader');
    if(loader){
      setTimeout(function(){
        loader.style.opacity='0';
        loader.style.visibility='hidden';
        setTimeout(function(){loader.remove();},500);
      },300);
    }
  });
</script>

<!-- NAVBAR: kiri = menu | tengah = logo | kanan = CTA (seperti referensi) -->
<nav class="navbar" aria-label="Main navigation">
  <div class="navbar-inner">
    <button class="navbar-toggle" onclick="toggleNavMenu()" aria-label="Toggle Menu">
      <span class="navbar-toggle__bar"></span>
      <span class="navbar-toggle__bar"></span>
      <span class="navbar-toggle__bar"></span>
    </button>

    <div class="navbar-zone navbar-zone--links">
      <ul class="nav-menu">
        <li><a href="/">Home</a></li>
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
        @if(auth()->user()->is_admin)
          <a href="{{ route('admin.dashboard') }}" class="navbar-cta navbar-cta--dashboard">Dashboard</a>
        @endif
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
  function toggleNavMenu() {
    document.querySelector('.navbar-inner').classList.toggle('nav-open');
  }

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