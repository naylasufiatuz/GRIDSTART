<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GridStart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/gridstart.css') }}">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
  <ul class="nav-menu">
    <li><a href="/">Roadmap</a></li>
    <li><a href="/simulasi">Simulasi</a></li>
    <li><a href="/leaderboard">Leaderboard</a></li>
    <li><a href="/contact">Contact</a></li>
  </ul>

  <a href="/" class="logo-center">
    <img src="{{ asset('images/GridStart_logo.png') }}" alt="GridStart" class="logo-img"/>
    <span class="logo-name">GRID<em>START</em></span>
  </a>

  @guest
    <a href="/login" class="cta-btn">Mulai Belajar</a>
  @endguest
  @auth
    <a href="/profile" class="cta-btn">Profile</a>
  @endauth
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

</body>
</html>