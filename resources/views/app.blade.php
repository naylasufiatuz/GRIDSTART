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
    <li>Roadmap</li>
    <li>Edukasi</li>
    <li>Simulasi</li>
    <li>Support</li>
  </ul>
  
  <div class="logo-text">
    <span>G</span>rid <span>S</span>tart
  </div>

  <a href="/signon" class="cta-btn">Mulai Belajar</a>
</nav>

<!-- CONTENT MASUK SINI -->
@yield('content')
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
</body>
</html>