@extends('app')

@section('content')

<!-- HERO -->
<section class="hero">
  <div class="hero-content fade-up">
    <small>SAFETY FIRST · F1 MINDSET</small>
    <h1>Grid Start</h1>
    <p>
      Edukasi keselamatan berkendara dengan pendekatan motorsport.
      Belajar dari START GRID sampai FINISH LINE.
    </p>
    <a href="#">Jelajahi Roadmap</a>
  </div>
</section>

<!-- ROADMAP -->
<section class="roadmap-section">

    <div class="roadmap-container">

        <!-- LEFT VISUAL -->
        <div class="roadmap-visual reveal-left">
            <div class="visual-box"></div>
        </div>

        <!-- RIGHT CONTENT -->
        <div class="roadmap-content">

            <p class="roadmap-sub reveal-top">LEARNING TRACE • ROADMAP</p>
            <h1 class="roadmap-title reveal-top delay-1">Race Roadmap</h1>

            <div class="roadmap-list">
                <a href="/start-grid" class="roadmap-item reveal-item delay-1 start">
                    <span class="number">1</span>
                    <p>START GRID</p>
                </a>

                <a href="/yellow-flag" class="roadmap-item reveal-item delay-2 yellow">
                    <span class="number">2</span>
                    <p>YELLOW FLAG</p>
                </a>

                <a href="/racing-line" class="roadmap-item reveal-item delay-3 green">
                    <span class="number">3</span>
                    <p>RACING LINE</p>
                </a>

                <a href="/brake-zone" class="roadmap-item reveal-item delay-4 red">
                    <span class="number">4</span>
                    <p>BRAKE ZONE</p>
                </a>

                <div class="roadmap-item reveal-item delay-5 purple">
                    <span class="number">5</span>
                    <p>PIT STOP</p>
                </div>

                <div class="roadmap-item reveal-item delay-6 blue">
                    <span class="number">5</span>
                    <p>SIMULATION</p>
                </div>

                <div class="roadmap-item reveal-item delay-7 finish">
                    <span class="number dark"></span>
                    <p>FINISH LINE</p>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection