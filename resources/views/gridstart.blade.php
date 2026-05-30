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
            DRIVE SAFE • LEARN • PLAY • RACE • DRIVE SAFE • LEARN • PLAY • RACE •
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

  <div class="hero-bottom-left">6 Learning Stages</div>
</section>

<section class="roadmap-section">

    <div class="roadmap-container" id="roadmap">

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
            Open Other Educational Videos
            </button>
        </div>
        </div>

        <div class="modal-videos" id="modal-videos" onclick="if(event.target===this)this.style.display='none'">
        <div class="modal-content">
            <div class="modal-header">
            <h3>Educational Videos</h3>
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

            <a href="https://www.youtube.com/watch?v=WJ-mx84hM6c" target="_blank" class="modal-video-thumb">
                <img src="https://img.youtube.com/vi/WJ-mx84hM6c/maxresdefault.jpg" alt="Video 3"/>
                <div class="modal-play-btn">
                <svg viewBox="0 0 24 24" fill="white" width="28" height="28"><path d="M8 5v14l11-7z"/></svg>
                </div>
            </a>

            </div>
        </div>
        </div>

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
                    <a href="#" onclick="alert('Kamu harus Login dulu ya untuk bisa main Simulasi!'); window.location.href='/login'; return false;" class="roadmap-item reveal-item delay-6 blue" style="text-decoration: none; cursor: pointer; filter: blur(2.5px); opacity: 0.6; transition: 0.3s;">
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
      <p class="top-drivers-desc">Pembalap terbaik minggu ini — apakah kamu ada di sini?</p>
    </div>

    @php
      $topDrivers = \App\Models\GameScore::with('user')
        ->orderBy('score', 'desc')
        ->take(3)
        ->get();
    @endphp

    @if($topDrivers->count() > 0)
      @php
        $maxScore = $topDrivers[0]->score > 0 ? $topDrivers[0]->score : 1;
      @endphp
    <div class="top-drivers-podium">

    {{-- P2 --}}
    @if($topDrivers->count() >= 2)
    @php
      $p2Pct = min(100, max(20, ($topDrivers[1]->score / $maxScore) * 100));
    @endphp
    <div class="td-card p2 reveal-item delay-1">
        <div class="td-hud-grid"></div>
        <div class="td-card-glow"></div>
        <div class="td-rank-badge silver-badge">2</div>
        
        <div class="td-avatar">
          <div class="td-avatar-ring"></div>
          <div class="td-hud-scanner"></div>
          <span class="td-avatar-text">{{ strtoupper(substr($topDrivers[1]->user->username, 0, 2)) }}</span>
        </div>

        <div class="td-name">{{ $topDrivers[1]->user->username }}</div>
        
        <div class="td-score-wrap">
          <span class="td-score-value">{{ number_format($topDrivers[1]->score) }}</span>
          <span class="td-score-label">POINTS</span>
        </div>

        <div class="td-telemetry-box">
          <div class="td-telemetry-label">TELEMETRY SCORE</div>
          <div class="td-telemetry-bar-bg">
            <div class="td-telemetry-bar-fill" style="width: {{ $p2Pct }}%;"></div>
          </div>
          <div class="td-telemetry-meta">
            <span>IDX: P2/{{ $topDrivers->count() }}</span>
            <span>EFF: {{ round($p2Pct, 1) }}%</span>
          </div>
        </div>

        @if($topDrivers[1]->best_time)
        <div class="td-time">⏱ {{ $topDrivers[1]->best_time }}</div>
        @endif
        <div class="td-card-shine"></div>
    </div>
    @endif

    {{-- P1 --}}
    @php
      $p1Pct = 100;
    @endphp
    <div class="td-card p1 reveal-item delay-2">
        <div class="td-hud-grid"></div>
        <div class="td-card-glow"></div>
        <div class="td-crown">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20"/><path d="M4 20l2-14 5 7 3-9 3 9 5-7 2 14"/></svg>
        </div>
        <div class="td-rank-badge gold-badge">1</div>
        
        <div class="td-avatar gold">
          <div class="td-avatar-ring"></div>
          <div class="td-hud-scanner"></div>
          <span class="td-avatar-text">{{ strtoupper(substr($topDrivers[0]->user->username, 0, 2)) }}</span>
        </div>

        <div class="td-name">{{ $topDrivers[0]->user->username }}</div>
        
        <div class="td-score-wrap">
          <span class="td-score-value">{{ number_format($topDrivers[0]->score) }}</span>
          <span class="td-score-label">POINTS</span>
        </div>

        <div class="td-telemetry-box">
          <div class="td-telemetry-label">TELEMETRY SCORE</div>
          <div class="td-telemetry-bar-bg">
            <div class="td-telemetry-bar-fill" style="width: {{ $p1Pct }}%;"></div>
          </div>
          <div class="td-telemetry-meta">
            <span>IDX: LEADER</span>
            <span>EFF: 100%</span>
          </div>
        </div>

        @if($topDrivers[0]->best_time)
        <div class="td-time">⏱ {{ $topDrivers[0]->best_time }}</div>
        @endif
        <div class="td-card-shine"></div>
    </div>

    {{-- P3 --}}
    @if($topDrivers->count() >= 3)
    @php
      $p3Pct = min(100, max(20, ($topDrivers[2]->score / $maxScore) * 100));
    @endphp
    <div class="td-card p3 reveal-item delay-3">
        <div class="td-hud-grid"></div>
        <div class="td-card-glow"></div>
        <div class="td-rank-badge bronze-badge">3</div>
        
        <div class="td-avatar bronze">
          <div class="td-avatar-ring"></div>
          <div class="td-hud-scanner"></div>
          <span class="td-avatar-text">{{ strtoupper(substr($topDrivers[2]->user->username, 0, 2)) }}</span>
        </div>

        <div class="td-name">{{ $topDrivers[2]->user->username }}</div>
        
        <div class="td-score-wrap">
          <span class="td-score-value">{{ number_format($topDrivers[2]->score) }}</span>
          <span class="td-score-label">POINTS</span>
        </div>

        <div class="td-telemetry-box">
          <div class="td-telemetry-label">TELEMETRY SCORE</div>
          <div class="td-telemetry-bar-bg">
            <div class="td-telemetry-bar-fill" style="width: {{ $p3Pct }}%;"></div>
          </div>
          <div class="td-telemetry-meta">
            <span>IDX: P3/{{ $topDrivers->count() }}</span>
            <span>EFF: {{ round($p3Pct, 1) }}%</span>
          </div>
        </div>

        @if($topDrivers[2]->best_time)
        <div class="td-time">⏱ {{ $topDrivers[2]->best_time }}</div>
        @endif
        <div class="td-card-shine"></div>
    </div>
    @endif

    </div>

    @else
    <div class="td-empty">
      <p>Belum ada driver yang terdaftar. Jadilah yang pertama!</p>
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