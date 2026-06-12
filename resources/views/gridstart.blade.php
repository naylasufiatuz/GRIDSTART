@extends('app')

@section('content')

<section class="hero">
  <div class="hero-top-left">SAFETY FIRST - F1 MINDSET</div>
  
  <div class="hero-content fade-up">
    <!-- Spectacular Looping Orbiting Text Ring -->
    <div class="hero-circular-badge" aria-hidden="true">
      <svg viewBox="0 0 200 200">
        <path id="textCircle" d="M 100, 100 m -75, 0 a 75,75 0 1,1 150,0 a 75,75 0 1,1 -150,0" fill="none" />
        <circle cx="100" cy="100" r="75" stroke="rgba(255, 255, 255, 0.05)" stroke-width="0.5" fill="none" stroke-dasharray="4,4" />
        <circle cx="100" cy="100" r="68" stroke="rgba(203, 184, 157, 0.03)" stroke-width="0.25" fill="none" />
        <text>
          <textPath href="#textCircle" startOffset="0%">
            DRIVE SAFE • LEARN • PLAY  • DRIVE SAFE • LEARN • PLAY •
          </textPath>
        </text>
      </svg>
    </div>

    <h1 class="hero-title">
      <span class="hero-word grid">Grid</span><span class="hero-word start">Start</span>
    </h1>
    <p>
      Edukasi keselamatan berkendara dengan pendekatan motorsport.<br>
      Belajar dari START GRID sampai FINISH LINE.
    </p>
    <a href="#roadmap">Jelajahi Roadmap</a>
  </div>
  
</section>

<section class="roadmap-section" id="roadmap">

    <div class="roadmap-container">

        <div class="roadmap-visual reveal-left">
        <div class="video-wrapper">
            <a href="https://www.youtube.com/watch?v=fVl88Q5DJ2w" target="_blank" class="video-thumb">
            <img src="https://img.youtube.com/vi/fVl88Q5DJ2w/maxresdefault.jpg" alt="Edukasi Berkendara"/>
            <div class="play-btn">
                <svg viewBox="0 0 24 24" fill="white" width="48" height="48">
                <path d="M8 5v14l11-7z"/>
                </svg>
            </div>
            </a>

            <button class="btn-other-videos" onclick="document.getElementById('modal-videos').style.display='flex'">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                <path d="M15 10l4.553-2.277A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
            </svg>
            BUKA VIDEO TUTORIAL LAINNYA
            </button>
        </div>
        </div>

        <div class="modal-videos" id="modal-videos" onclick="if(event.target===this)this.style.display='none'">
        <div class="modal-content">
            <div class="modal-header">
            <h3>Video Edukasi Berkendara</h3>
            <button class="modal-close" onclick="document.getElementById('modal-videos').style.display='none'">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
                <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
            </div>
            <div class="modal-grid">

            <a href="https://www.youtube.com/watch?v=fotpQo7xyy0" target="_blank" class="modal-video-thumb">
                <img src="https://img.youtube.com/vi/fotpQo7xyy0/maxresdefault.jpg" alt="Video 1"/>
                <div class="modal-play-btn">
                <svg viewBox="0 0 24 24" fill="white" width="28" height="28"><path d="M8 5v14l11-7z"/></svg>
                </div>
            </a>

            <a href="https://www.youtube.com/watch?v=vzMFWea-X7g" target="_blank" class="modal-video-thumb">
                <img src="https://img.youtube.com/vi/vzMFWea-X7g/maxresdefault.jpg" alt="Video 2"/>
                <div class="modal-play-btn">
                <svg viewBox="0 0 24 24" fill="white" width="28" height="28"><path d="M8 5v14l11-7z"/></svg>
                </div>
            </a>

            <a href="https://www.youtube.com/watch?v=JuEvK-zCqio" target="_blank" class="modal-video-thumb">
                <img src="https://i.ytimg.com/vi/JuEvK-zCqio/hqdefault.jpg" alt="Video 3"/>
                <div class="modal-play-btn">
                <svg viewBox="0 0 24 24" fill="white" width="28" height="28"><path d="M8 5v14l11-7z"/></svg>
                </div>
            </a>

            </div>
        </div>
        </div>

        <div class="roadmap-content">

            <p class="roadmap-sub reveal-top">JALUR BELAJARMU • RACE ROADMAP</p>
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

                <a href="/pit-stop" class="roadmap-item reveal-item delay-5 purple">
                    <span class="number">5</span>
                    <p>PIT STOP</p>
                </a>

                @auth
                    <a href="/simulasi" class="roadmap-item reveal-item delay-6 blue" style="text-decoration: none; cursor: pointer;">
                        <span class="number">5</span>
                        <p>SIMULATION</p>
                    </a>
                @endauth

                @guest
                    <a href="#" onclick="showLoginAlert(event)" class="roadmap-item reveal-item delay-6 blue" style="text-decoration: none; cursor: pointer; filter: blur(2.5px); opacity: 0.6; transition: 0.3s;">
                        <span class="number">5</span>
                        <p>SIMULATION</p>
                    </a>
                @endguest
                <a href="/finish-line" class="roadmap-item reveal-item delay-7 finish">
                    <span class="number dark"></span>
                    <p>FINISH LINE</p>
                </a>

            </div>

        </div>

    </div>

</section>

<section class="top-drivers-section">
  <div class="top-drivers-container">

    <!-- Holographic grid backing & speed lines -->
    <div class="td-radar-grid" aria-hidden="true"></div>
    <div class="td-particles" aria-hidden="true">
      <span></span><span></span><span></span><span></span><span></span>
      <span></span><span></span><span></span><span></span><span></span>
    </div>

    <div class="top-drivers-header">
      <p class="top-drivers-sub">GRIDSTART CHAMPIONSHIP</p>
      <h2 class="top-drivers-title">Top <span class="title-accent">Drivers</span></h2>
      <p class="top-drivers-desc">Pembalap terbaik minggu ini — apakah namamu ada di sini?</p>
    </div>

    @php
      $topDrivers = \App\Models\GameScore::with('user')
        ->orderBy('score', 'desc')
        ->take(3)
        ->get();
    @endphp

    @if($topDrivers->count() > 0)
    <div class="lb-grid-podium">

      {{-- P2 SLOT (Staggered back-left) --}}
      @if($topDrivers->count() >= 2)
      <div class="podium-slot p2 reveal-item delay-1">
        <div class="podium-hud-bg"></div>
        <div class="podium-halo"></div>
        <div class="slot-pos-badge">P2</div>
        <div class="slot-avatar-frame">
          <div class="slot-telemetry-ring"></div>
          <div class="slot-avatar-scanner"></div>
          <span class="slot-avatar-initials">{{ strtoupper(substr($topDrivers[1]->user->username, 0, 2)) }}</span>
        </div>
        <div class="slot-driver-name">{{ $topDrivers[1]->user->username }}</div>
        <div class="slot-score-value">{{ number_format($topDrivers[1]->score) }}</div>
        <div class="slot-sub-info">PTS</div>
        @if($topDrivers[1]->best_time)
          <div class="slot-sub-info" style="color:var(--hud-gold);">Lap: {{ $topDrivers[1]->best_time }}</div>
        @endif
      </div>
      @endif

      {{-- P1 SLOT (Pole front-center) --}}
      <div class="podium-slot p1 reveal-item delay-2">
        <div class="podium-hud-bg"></div>
        <div class="podium-halo"></div>
        <svg class="podium-crown-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M3 17l3-10 4 6 4-6 3 10H3z"/>
          <path d="M7 14h10"/>
        </svg>
        <div class="slot-pos-badge">P1 POLE</div>
        <div class="slot-avatar-frame">
          <div class="slot-telemetry-ring"></div>
          <div class="slot-avatar-scanner"></div>
          <span class="slot-avatar-initials">{{ strtoupper(substr($topDrivers[0]->user->username, 0, 2)) }}</span>
        </div>
        <div class="slot-driver-name">{{ $topDrivers[0]->user->username }}</div>
        <div class="slot-score-value" style="color:var(--hud-gold);">{{ number_format($topDrivers[0]->score) }}</div>
        <div class="slot-sub-info" style="font-weight:800;">PTS</div>
        @if($topDrivers[0]->best_time)
          <div class="slot-sub-info" style="color:var(--hud-gold);">Lap: {{ $topDrivers[0]->best_time }}</div>
        @endif
      </div>

      {{-- P3 SLOT (Staggered back-right) --}}
      @if($topDrivers->count() >= 3)
      <div class="podium-slot p3 reveal-item delay-3">
        <div class="podium-hud-bg"></div>
        <div class="podium-halo"></div>
        <div class="slot-pos-badge">P3</div>
        <div class="slot-avatar-frame">
          <div class="slot-telemetry-ring"></div>
          <div class="slot-avatar-scanner"></div>
          <span class="slot-avatar-initials">{{ strtoupper(substr($topDrivers[2]->user->username, 0, 2)) }}</span>
        </div>
        <div class="slot-driver-name">{{ $topDrivers[2]->user->username }}</div>
        <div class="slot-score-value">{{ number_format($topDrivers[2]->score) }}</div>
        <div class="slot-sub-info">PTS</div>
        @if($topDrivers[2]->best_time)
          <div class="slot-sub-info" style="color:var(--hud-gold);">Lap: {{ $topDrivers[2]->best_time }}</div>
        @endif
      </div>
      @endif

    </div>

    @else
    <div class="td-empty">
      <p>Belum ada driver di grid. Selesaikan semua stage dan jadilah yang pertama!</p>
    </div>
    @endif

    <div class="td-cta">
      <a href="/leaderboard" class="td-btn">
        <span class="td-btn-text">Lihat Semua Driver</span>
        <span class="td-btn-icon">→</span>
      </a>
    </div>

  </div>
</section>



@endsection

@section('scripts')
<script>
    function showLoginAlert(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Akses Terbatas',
            text: 'Untuk masuk ke simulasi berkendara, Anda wajib login terlebih dahulu.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6', // gridstart home uses blue accent for simulation
            cancelButtonColor: '#3f3a36',
            confirmButtonText: 'Login Sekarang',
            cancelButtonText: 'Batal',
            background: '#f7f3ee',
            color: '#3f3a36'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    }
</script>
@endsection