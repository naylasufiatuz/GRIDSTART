@extends('app')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
@endsection

@section('content')

<section class="leaderboard-section">
  <div class="leaderboard-container">

    {{-- ======================== RACE CONTROL HEADER ======================== --}}
    <div class="lb-header">
      <p class="lb-sub">GRIDSTART CHAMPIONSHIP</p>
      <h1 class="lb-title">Driver Standings</h1>
      <p class="lb-desc">All-time live standings feed — who dominates the starting grid?</p>
    </div>

    {{-- ======================== F1 STARTING LIGHTS BOARD ======================== --}}
    <div class="f1-lights-wrapper" id="start-light-board">
      <div class="f1-lights-title">RACE CONTROL: DATA TRANSMISSION</div>
      <div class="f1-light-grid">
        <div class="f1-light-pillar">
          <div class="f1-light-bulb"></div>
          <div class="f1-light-bulb"></div>
        </div>
        <div class="f1-light-pillar">
          <div class="f1-light-bulb"></div>
          <div class="f1-light-bulb"></div>
        </div>
        <div class="f1-light-pillar">
          <div class="f1-light-bulb"></div>
          <div class="f1-light-bulb"></div>
        </div>
        <div class="f1-light-pillar">
          <div class="f1-light-bulb"></div>
          <div class="f1-light-bulb"></div>
        </div>
        <div class="f1-light-pillar">
          <div class="f1-light-bulb"></div>
          <div class="f1-light-bulb"></div>
        </div>
      </div>
    </div>

    {{-- ======================== TACTILE TABS SWITCHER ======================== --}}
    <div class="lb-tabs-container">
      <div class="lb-hud-tabs">
        <button class="lb-hud-tab active" onclick="switchTab('points', this)">Championship Points</button>
        <button class="lb-hud-tab" onclick="switchTab('time', this)">Fastest Laps</button>
      </div>
    </div>

    {{-- ======================== FADE-IN HUD BODY ======================== --}}
    <div class="lb-hud-ready">

      {{-- ====================================================================
           POINTS CHAMPIONSHIP TAB
           ==================================================================== --}}
      <div id="tab-points">

        {{-- DRIVER COCKPIT STEERING HUD (User standing status) --}}
        <div class="my-standing">
          @if(Auth::check())
            @if($userBestPoint)
            <div class="cockpit-hud-capsule">
              <div class="cockpit-hud-inner">
                <div class="cockpit-rank-dial">
                  <span class="cockpit-rank-number">P{{ $userPointRank }}</span>
                  <span class="cockpit-rank-label">Rank</span>
                </div>
                <div class="cockpit-pilot-data">
                  <div class="cockpit-pilot-header">
                    <div class="cockpit-avatar">
                      {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                    </div>
                    <div>
                      <p class="cockpit-pilot-name">{{ Auth::user()->username }}</p>
                      <div class="cockpit-status-readout">
                        <span class="readout-indicator"></span>
                        <span class="readout-text">SYSTEM ACTIVE · DRS ONLINE</span>
                      </div>
                    </div>
                  </div>
                  <div class="cockpit-pilot-stats">
                    <div class="cockpit-stat-item">
                      <span class="cockpit-stat-label">Personal Best</span>
                      <span class="cockpit-stat-val">{{ number_format($userBestPoint->score) }} pts</span>
                    </div>
                    <div class="cockpit-stat-item">
                      <span class="cockpit-stat-label">Best Lap</span>
                      <span class="cockpit-stat-val">{{ $userBestPoint->best_time ?? '—' }}</span>
                    </div>
                  </div>
                </div>
                <div class="cockpit-hud-actions">
                  <a href="/simulasi" class="cockpit-return-btn">
                    <span>Return to Simulation</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                  </a>
                </div>
              </div>
            </div>
            @else
            <div class="cockpit-hud-capsule">
              <div class="cockpit-hud-inner">
                <div class="cockpit-hud-empty">
                  <p>System offline — You haven't registered any lap times on the leaderboard yet!</p>
                  <a href="/simulasi" class="cockpit-return-btn" style="display:inline-flex; float:none;">Launch Simulation</a>
                </div>
              </div>
            </div>
            @endif
          @else
          <div class="cockpit-hud-capsule" style="border-color: rgba(209, 122, 122, 0.25);">
            <div class="cockpit-hud-inner">
              <div class="cockpit-hud-empty">
                <p>System locked — Sign on as a driver to track your real-time ranking!</p>
                <a href="/login" class="cockpit-return-btn" style="display:inline-flex; float:none;">Pilot Log On</a>
              </div>
            </div>
          </div>
          @endif
        </div>

        {{-- POLE STAGGERED GRID PODIUM (TOP 3 DRIVERS) --}}
        @if($byPoints->count() >= 3)
        <div class="lb-grid-podium">
          
          {{-- P2 SLOT (Staggered back-left) --}}
          <div class="podium-slot p2">
            <div class="podium-hud-bg"></div>
            <div class="podium-halo"></div>
            <div class="slot-pos-badge">P2</div>
            <div class="slot-avatar-frame">
              <div class="slot-telemetry-ring"></div>
              <div class="slot-avatar-scanner"></div>
              <span class="slot-avatar-initials">{{ strtoupper(substr($byPoints[1]->user->username, 0, 2)) }}</span>
            </div>
            <div class="slot-driver-name">{{ $byPoints[1]->user->username }}</div>
            <div class="slot-score-value">{{ number_format($byPoints[1]->score) }}</div>
            <div class="slot-sub-info">PTS</div>
            @if($byPoints[1]->best_time)
              <div class="slot-sub-info" style="color:var(--hud-gold);">Lap: {{ $byPoints[1]->best_time }}</div>
            @endif
          </div>

          {{-- P1 SLOT (Pole front-center) --}}
          <div class="podium-slot p1">
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
              <span class="slot-avatar-initials">{{ strtoupper(substr($byPoints[0]->user->username, 0, 2)) }}</span>
            </div>
            <div class="slot-driver-name">{{ $byPoints[0]->user->username }}</div>
            <div class="slot-score-value" style="color:var(--hud-gold);">{{ number_format($byPoints[0]->score) }}</div>
            <div class="slot-sub-info" style="font-weight:800;">PTS</div>
            @if($byPoints[0]->best_time)
              <div class="slot-sub-info" style="color:var(--hud-gold);">Lap: {{ $byPoints[0]->best_time }}</div>
            @endif
          </div>

          {{-- P3 SLOT (Staggered back-right) --}}
          <div class="podium-slot p3">
            <div class="podium-hud-bg"></div>
            <div class="podium-halo"></div>
            <div class="slot-pos-badge">P3</div>
            <div class="slot-avatar-frame">
              <div class="slot-telemetry-ring"></div>
              <div class="slot-avatar-scanner"></div>
              <span class="slot-avatar-initials">{{ strtoupper(substr($byPoints[2]->user->username, 0, 2)) }}</span>
            </div>
            <div class="slot-driver-name">{{ $byPoints[2]->user->username }}</div>
            <div class="slot-score-value">{{ number_format($byPoints[2]->score) }}</div>
            <div class="slot-sub-info">PTS</div>
            @if($byPoints[2]->best_time)
              <div class="slot-sub-info" style="color:var(--hud-gold);">Lap: {{ $byPoints[2]->best_time }}</div>
            @endif
          </div>

        </div>
        @endif

        {{-- SHOW ALL TRIGGER --}}
        <div class="expand-wrap">
          <button class="expand-btn" onclick="toggleTable('pts-table', this)">
            <span>Lihat Semua</span>
            <svg class="expand-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <small class="expand-note">{{ $byPoints->count() }} active pilots on track</small>
        </div>

        {{-- ASYMMETRIC RACETRACK LAPS FEED --}}
        <div id="pts-table" class="expandable-table" style="display:none;">
          <div class="lb-track-feed-wrapper">
            
            @forelse($byPoints as $i => $row)
              @php
                // Calculate percentage relative to leader for bar visualization
                $percentage = $byPoints[0]->score > 0 ? ($row->score / $byPoints[0]->score) * 100 : 0;
              @endphp
              <div class="telemetry-stripe {{ Auth::check() && $row->user_id === Auth::user()->id_user ? 'stripe-row-me' : '' }}">
                
                {{-- Slanted position indicator --}}
                <div class="stripe-rank-indicator {{ $i===0?'pos-gold':($i===1?'pos-silver':($i===2?'pos-bronze':'')) }}">
                  {{ $i+1 }}
                </div>

                {{-- Driver Info --}}
                <div class="stripe-driver-cell">
                  <div class="stripe-avatar">
                    {{ strtoupper(substr($row->user->username, 0, 2)) }}
                  </div>
                  <div class="stripe-driver-details">
                    <span class="stripe-driver-name">{{ $row->user->username }}</span>
                    <span class="stripe-driver-meta">Lap Time: {{ $row->best_time ?? '—' }}</span>
                  </div>
                </div>

                {{-- Telemetry data & custom gamified badges --}}
                <div class="stripe-telemetry-data">
                  
                  {{-- Badges System --}}
                  <div class="stripe-badges-container">
                    @if($i === 0)
                      <span class="hud-badge hud-badge-gold">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l3-10 4 6 4-6 3 10H3z"/><path d="M7 14h10"/></svg>
                        POLE
                      </span>
                      <span class="hud-badge hud-badge-green">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        APEX
                      </span>
                    @elseif($i === 1 || $i === 2)
                      <span class="hud-badge hud-badge-blue">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        PODIUM
                      </span>
                    @endif

                    @if($i % 3 === 0 && $i > 0)
                      <span class="hud-badge hud-badge-green">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
                        SECTOR 1
                      </span>
                    @elseif($i % 2 === 0 && $i > 2)
                      <span class="hud-badge hud-badge-red">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polygon points="17 6 23 6 23 12"/></svg>
                        STREAK
                      </span>
                    @endif
                  </div>

                  {{-- Horizontal Delta Progress scale --}}
                  <div class="stripe-delta-visualizer">
                    <div class="delta-label">
                      @if($i === 0)
                        LEADER
                      @else
                        +{{ number_format($byPoints[0]->score - $row->score) }} pts
                      @endif
                    </div>
                    <div class="delta-track-bar">
                      <div class="delta-fill-bar" style="width: {{ $percentage }}%"></div>
                    </div>
                  </div>

                  {{-- Digital Scorecard --}}
                  <div class="stripe-score-wrap">
                    <span class="stripe-score-value">{{ number_format($row->score) }}</span>
                    <div class="stripe-score-desc">PTS</div>
                  </div>

                </div>

              </div>
            @empty
              <div class="telemetry-stripe" style="justify-content:center; padding: 40px 20px;">
                <p style="color:var(--taupe-soft); font-style:italic;">No active pilots on the championship track yet.</p>
              </div>
            @endforelse

          </div>
        </div>

      </div>

      {{-- ====================================================================
           FASTEST LAPS TAB
           ==================================================================== --}}
      <div id="tab-time" style="display:none;">

        {{-- DRIVER COCKPIT STEERING HUD (User standing status) --}}
        <div class="my-standing">
          @if(Auth::check())
            @if($userBestTime)
            <div class="cockpit-hud-capsule">
              <div class="cockpit-hud-inner">
                <div class="cockpit-rank-dial" style="border-color: rgba(168, 169, 173, 0.3);">
                  <span class="cockpit-rank-number">P{{ $userTimeRank }}</span>
                  <span class="cockpit-rank-label">Rank</span>
                </div>
                <div class="cockpit-pilot-data">
                  <div class="cockpit-pilot-header">
                    <div class="cockpit-avatar">
                      {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                    </div>
                    <div>
                      <p class="cockpit-pilot-name">{{ Auth::user()->username }}</p>
                      <div class="cockpit-status-readout">
                        <span class="readout-indicator"></span>
                        <span class="readout-text">SYSTEM ACTIVE · LAP COUNTER ACTIVE</span>
                      </div>
                    </div>
                  </div>
                  <div class="cockpit-pilot-stats">
                    <div class="cockpit-stat-item">
                      <span class="cockpit-stat-label">Best Lap Time</span>
                      <span class="cockpit-stat-val" style="color:var(--hud-silver);">{{ $userBestTime->best_time }}</span>
                    </div>
                    <div class="cockpit-stat-item">
                      <span class="cockpit-stat-label">Best Score</span>
                      <span class="cockpit-stat-val">{{ number_format($userBestTime->score) }} pts</span>
                    </div>
                  </div>
                </div>
                <div class="cockpit-hud-actions">
                  <a href="/simulasi" class="cockpit-return-btn">
                    <span>Return to Grid</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                  </a>
                </div>
              </div>
            </div>
            @else
            <div class="cockpit-hud-capsule">
              <div class="cockpit-hud-inner">
                <div class="cockpit-hud-empty">
                  <p>System offline — You haven't registered any lap times on the leaderboard yet!</p>
                  <a href="/simulasi" class="cockpit-return-btn" style="display:inline-flex; float:none;">Launch Simulation</a>
                </div>
              </div>
            </div>
            @endif
          @else
          <div class="cockpit-hud-capsule" style="border-color: rgba(209, 122, 122, 0.25);">
            <div class="cockpit-hud-inner">
              <div class="cockpit-hud-empty">
                <p>System locked — Sign on as a driver to track your real-time ranking!</p>
                <a href="/login" class="cockpit-return-btn" style="display:inline-flex; float:none;">Pilot Log On</a>
              </div>
            </div>
          </div>
          @endif
        </div>

        {{-- POLE STAGGERED GRID PODIUM (TOP 3 FASTEST LAP DRIVERS) --}}
        @if($byTime->count() >= 3)
        <div class="lb-grid-podium">
          
          {{-- P2 SLOT (Staggered back-left) --}}
          <div class="podium-slot p2">
            <div class="podium-hud-bg"></div>
            <div class="podium-halo"></div>
            <div class="slot-pos-badge">P2</div>
            <div class="slot-avatar-frame">
              <div class="slot-telemetry-ring"></div>
              <div class="slot-avatar-scanner"></div>
              <span class="slot-avatar-initials">{{ strtoupper(substr($byTime[1]->user->username, 0, 2)) }}</span>
            </div>
            <div class="slot-driver-name">{{ $byTime[1]->user->username }}</div>
            <div class="slot-score-value">{{ $byTime[1]->best_time }}</div>
            <div class="slot-sub-info">LAP TIME</div>
            <div class="slot-sub-info" style="color:var(--hud-silver);">Score: {{ number_format($byTime[1]->score) }} pts</div>
          </div>

          {{-- P1 SLOT (Pole front-center) --}}
          <div class="podium-slot p1">
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
              <span class="slot-avatar-initials">{{ strtoupper(substr($byTime[0]->user->username, 0, 2)) }}</span>
            </div>
            <div class="slot-driver-name">{{ $byTime[0]->user->username }}</div>
            <div class="slot-score-value" style="color:var(--hud-gold);">{{ $byTime[0]->best_time }}</div>
            <div class="slot-sub-info" style="font-weight:800;">LAP TIME</div>
            <div class="slot-sub-info" style="color:var(--hud-gold);">Score: {{ number_format($byTime[0]->score) }} pts</div>
          </div>

          {{-- P3 SLOT (Staggered back-right) --}}
          <div class="podium-slot p3">
            <div class="podium-hud-bg"></div>
            <div class="podium-halo"></div>
            <div class="slot-pos-badge">P3</div>
            <div class="slot-avatar-frame">
              <div class="slot-telemetry-ring"></div>
              <div class="slot-avatar-scanner"></div>
              <span class="slot-avatar-initials">{{ strtoupper(substr($byTime[2]->user->username, 0, 2)) }}</span>
            </div>
            <div class="slot-driver-name">{{ $byTime[2]->user->username }}</div>
            <div class="slot-score-value">{{ $byTime[2]->best_time }}</div>
            <div class="slot-sub-info">LAP TIME</div>
            <div class="slot-sub-info" style="color:var(--hud-bronze);">Score: {{ number_format($byTime[2]->score) }} pts</div>
          </div>

        </div>
        @endif

        {{-- SHOW ALL TRIGGER --}}
        <div class="expand-wrap">
          <button class="expand-btn" onclick="toggleTable('time-table', this)">
            <span>Lihat Semua</span>
            <svg class="expand-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <small class="expand-note">{{ $byTime->count() }} active pilots on track</small>
        </div>

        {{-- ASYMMETRIC RACETRACK LAPS FEED --}}
        <div id="time-table" class="expandable-table" style="display:none;">
          <div class="lb-track-feed-wrapper">
            
            @forelse($byTime as $i => $row)
              @php
                // Percentage based on scores to render bar filling
                $percentage = $byTime[0]->score > 0 ? ($row->score / $byTime[0]->score) * 100 : 0;
              @endphp
              <div class="telemetry-stripe {{ Auth::check() && $row->user_id === Auth::user()->id_user ? 'stripe-row-me' : '' }}">
                
                {{-- Slanted position indicator --}}
                <div class="stripe-rank-indicator {{ $i===0?'pos-gold':($i===1?'pos-silver':($i===2?'pos-bronze':'')) }}">
                  {{ $i+1 }}
                </div>

                {{-- Driver Info --}}
                <div class="stripe-driver-cell">
                  <div class="stripe-avatar">
                    {{ strtoupper(substr($row->user->username, 0, 2)) }}
                  </div>
                  <div class="stripe-driver-details">
                    <span class="stripe-driver-name">{{ $row->user->username }}</span>
                    <span class="stripe-driver-meta">Score Points: {{ number_format($row->score) }} pts</span>
                  </div>
                </div>

                {{-- Telemetry data & badges --}}
                <div class="stripe-telemetry-data">
                  
                  {{-- Badges System --}}
                  <div class="stripe-badges-container">
                    @if($i === 0)
                      <span class="hud-badge hud-badge-gold">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        RECORD
                      </span>
                      <span class="hud-badge hud-badge-green">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        TRACKMASTER
                      </span>
                    @elseif($i === 1 || $i === 2)
                      <span class="hud-badge hud-badge-blue">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        QUICK
                      </span>
                    @endif

                    @if($i % 3 === 0 && $i > 0)
                      <span class="hud-badge hud-badge-blue">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1 .4-1 1v6c0 .6.4 1 1 1h1m12 0h2m-12 0c0 1.7 1.3 3 3 3s3-1.3 3-3M6 17c0 1.7 1.3 3 3 3s3-1.3 3-3"/></svg>
                        DRIFT
                      </span>
                    @elseif($i % 2 === 0 && $i > 2)
                      <span class="hud-badge hud-badge-green">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        DRS ZONE
                      </span>
                    @endif
                  </div>

                  {{-- Horizontal Delta Progress --}}
                  <div class="stripe-delta-visualizer">
                    <div class="delta-label">
                      @if($i === 0)
                        SPEED LEADER
                      @else
                        Lap Time: {{ $row->best_time }}
                      @endif
                    </div>
                    <div class="delta-track-bar">
                      <div class="delta-fill-bar" style="width: {{ $percentage }}%"></div>
                    </div>
                  </div>

                  {{-- Digital Scorecard --}}
                  <div class="stripe-score-wrap">
                    <span class="stripe-score-value" style="color: var(--hud-silver);">{{ $row->best_time }}</span>
                    <div class="stripe-score-desc">LAP</div>
                  </div>

                </div>

              </div>
            @empty
              <div class="telemetry-stripe" style="justify-content:center; padding: 40px 20px;">
                <p style="color:var(--taupe-soft); font-style:italic;">No lap record logs on the championship track yet.</p>
              </div>
            @endforelse

          </div>
        </div>

      </div>

    </div>

  </div>
</section>

<script>
/**
 * Interactive F1 Start Lights board sequencing on page load
 */
document.addEventListener("DOMContentLoaded", function() {
  const bulbs = document.querySelectorAll(".f1-light-bulb");
  const lightsPanel = document.getElementById("start-light-board");
  
  if (bulbs.length > 0) {
    // Bulbs sequence styling
    // At 3.0s, all lights shut off (green state triggered)
    setTimeout(function() {
      if (statusMessage) {
        statusMessage.textContent = "LIGHTS OUT! GO GO GO!";
        statusMessage.style.color = "#52b757";
      }
      
      // Flash a quick green flash effect
      bulbs.forEach(b => {
        b.style.background = "#52b757";
        b.style.boxShadow = "0 0 20px #52b757, 0 0 35px #52b757";
      });
      
      // After another 1s, turn green lights off to clean cockpit console view
      setTimeout(function() {
        bulbs.forEach(b => {
          b.style.background = "#d9d2c9";
          b.style.boxShadow = "none";
        });
        if (statusMessage) {
          statusMessage.textContent = "LINK STABLE";
          statusMessage.style.color = "var(--hud-gold)";
        }
      }, 1000);
      
    }, 3000);
  }
});

/**
 * Switch tabs smoothly between Points and Time lap standing rosters
 */
function switchTab(tab, el) {
  const ptsTab = document.getElementById('tab-points');
  const timeTab = document.getElementById('tab-time');
  
  if (tab === 'points') {
    ptsTab.style.display = 'block';
    timeTab.style.display = 'none';
  } else {
    ptsTab.style.display = 'none';
    timeTab.style.display = 'block';
  }
  
  document.querySelectorAll('.lb-hud-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
}

/**
 * Custom expand and collapse drawer widget for driver grids
 */
function toggleTable(id, btn) {
  var el = document.getElementById(id);
  var arrow = btn.querySelector('.expand-arrow');
  var label = btn.querySelector('span');
  if (el.style.display === 'none') {
    el.style.display = 'block';
    arrow.style.transform = 'rotate(180deg)';
    label.textContent = 'Tutup Grid';
    setTimeout(function(){ el.scrollIntoView({ behavior:'smooth', block:'start' }); }, 120);
  } else {
    el.style.display = 'none';
    arrow.style.transform = '';
    label.textContent = 'Lihat Semua';
  }
}
</script>

@endsection