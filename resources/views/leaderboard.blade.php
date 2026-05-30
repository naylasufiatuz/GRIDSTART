@extends('app')

@section('content')

<section class="leaderboard-section">
  <div class="leaderboard-container">

    <div class="lb-header">
      <p class="lb-sub">GRIDSTART CHAMPIONSHIP</p>
      <h1 class="lb-title">Driver Standings</h1>
      <p class="lb-desc">All-time leaderboard — siapa yang paling jago?</p>
    </div>

    <div class="lb-tabs">
      <button class="lb-tab active" onclick="switchTab('points', this)">Points</button>
      <button class="lb-tab" onclick="switchTab('time', this)">Fastest Lap</button>
    </div>

    {{-- ======================== POINTS TAB ======================== --}}
    <div id="tab-points">

      {{-- posisi user --}}
      <div class="my-standing">
        @if(Auth::check())
          @if($userBestPoint)
          <div class="my-standing-inner">
            <div class="my-standing-pos">
              <span class="pos-number">P{{ $userPointRank }}</span>
              <span class="pos-cap">Posisi Kamu</span>
            </div>
            <div class="my-standing-info">
              <div class="avatar-sm">{{ strtoupper(substr(Auth::user()->username, 0, 2)) }}</div>
              <div>
                <p class="my-standing-name">{{ Auth::user()->username }}</p>
                <p class="my-standing-detail">{{ number_format($userBestPoint->score) }} pts · {{ $userBestPoint->best_time ?? '—' }}</p>
              </div>
            </div>
          </div>
          @else
          <div class="my-standing-inner my-standing-empty">
            <p>Kamu belum punya skor — <a href="/simulasi">main sekarang</a></p>
          </div>
          @endif
        @else
          <div class="my-standing-inner my-standing-empty">
            <p><a href="/login">Login</a> untuk melihat posisimu di klasemen</p>
          </div>
        @endif
      </div>

      {{-- podium --}}
      @if($byPoints->count() >= 3)
      <div class="lb-podium">
        <div class="podium-card p2">
          <div class="podium-pos">P2</div>
          <div class="podium-avatar">{{ strtoupper(substr($byPoints[1]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byPoints[1]->user->username }}</div>
          <div class="podium-score">{{ number_format($byPoints[1]->score) }}</div>
          @if($byPoints[1]->best_time)<div class="podium-time">{{ $byPoints[1]->best_time }}</div>@endif
        </div>
        <div class="podium-card p1">
          <div class="podium-pos">P1</div>
          <div class="podium-crown"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l3-10 4 6 4-6 3 10H3z"/><path d="M7 14h10"/></svg></div>
          <div class="podium-avatar gold">{{ strtoupper(substr($byPoints[0]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byPoints[0]->user->username }}</div>
          <div class="podium-score">{{ number_format($byPoints[0]->score) }}</div>
          @if($byPoints[0]->best_time)<div class="podium-time">{{ $byPoints[0]->best_time }}</div>@endif
        </div>
        <div class="podium-card p3">
          <div class="podium-pos">P3</div>
          <div class="podium-avatar bronze">{{ strtoupper(substr($byPoints[2]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byPoints[2]->user->username }}</div>
          <div class="podium-score">{{ number_format($byPoints[2]->score) }}</div>
          @if($byPoints[2]->best_time)<div class="podium-time">{{ $byPoints[2]->best_time }}</div>@endif
        </div>
      </div>
      @endif

      {{-- tombol lihat semua --}}
      <div class="expand-wrap">
        <button class="expand-btn" onclick="toggleTable('pts-table', this)">
          <span>Lihat Semua</span>
          <svg class="expand-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <small class="expand-note">{{ $byPoints->count() }} data tercatat</small>
      </div>

      {{-- tabel lengkap --}}
      <div id="pts-table" class="expandable-table" style="display:none;">
        <div class="lb-table-wrap">
          <table class="lb-table">
            <thead>
              <tr>
                <th>POS</th><th>DRIVER</th><th>PTS</th><th>BEST LAP</th><th>GAP</th>
              </tr>
            </thead>
            <tbody>
              @forelse($byPoints as $i => $row)
              <tr class="{{ Auth::check() && $row->user_id === Auth::user()->id_user ? 'row-me' : '' }}">
                <td>
                  <span class="pos-badge {{ $i===0?'pos-gold':($i===1?'pos-silver':($i===2?'pos-bronze':'')) }}">{{ $i+1 }}</span>
                </td>
                <td>
                  <div class="driver-cell">
                    <div class="avatar-sm">{{ strtoupper(substr($row->user->username, 0, 2)) }}</div>
                    <span>{{ $row->user->username }}</span>
                  </div>
                </td>
                <td><strong>{{ number_format($row->score) }}</strong></td>
                <td class="muted">{{ $row->best_time ?? '—' }}</td>
                <td class="muted">@if($i===0) — @else +{{ number_format($byPoints[0]->score - $row->score) }} @endif</td>
              </tr>
              @empty
              <tr><td colspan="5" class="empty-td">Belum ada skor.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- ======================== TIME TAB ======================== --}}
    <div id="tab-time" style="display:none;">

      {{-- posisi user --}}
      <div class="my-standing">
        @if(Auth::check())
          @if($userBestTime)
          <div class="my-standing-inner">
            <div class="my-standing-pos">
              <span class="pos-number">P{{ $userTimeRank }}</span>
              <span class="pos-cap">Posisi Kamu</span>
            </div>
            <div class="my-standing-info">
              <div class="avatar-sm">{{ strtoupper(substr(Auth::user()->username, 0, 2)) }}</div>
              <div>
                <p class="my-standing-name">{{ Auth::user()->username }}</p>
                <p class="my-standing-detail">{{ $userBestTime->best_time }} · {{ number_format($userBestTime->score) }} pts</p>
              </div>
            </div>
          </div>
          @else
          <div class="my-standing-inner my-standing-empty">
            <p>Kamu belum punya catatan waktu — <a href="/simulasi">main sekarang</a></p>
          </div>
          @endif
        @else
          <div class="my-standing-inner my-standing-empty">
            <p><a href="/login">Login</a> untuk melihat posisimu di klasemen</p>
          </div>
        @endif
      </div>

      {{-- podium --}}
      @if($byTime->count() >= 3)
      <div class="lb-podium">
        <div class="podium-card p2">
          <div class="podium-pos">P2</div>
          <div class="podium-avatar">{{ strtoupper(substr($byTime[1]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byTime[1]->user->username }}</div>
          <div class="podium-score">{{ $byTime[1]->best_time }}</div>
        </div>
        <div class="podium-card p1">
          <div class="podium-pos">P1</div>
          <div class="podium-crown"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l3-10 4 6 4-6 3 10H3z"/><path d="M7 14h10"/></svg></div>
          <div class="podium-avatar gold">{{ strtoupper(substr($byTime[0]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byTime[0]->user->username }}</div>
          <div class="podium-score">{{ $byTime[0]->best_time }}</div>
        </div>
        <div class="podium-card p3">
          <div class="podium-pos">P3</div>
          <div class="podium-avatar bronze">{{ strtoupper(substr($byTime[2]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byTime[2]->user->username }}</div>
          <div class="podium-score">{{ $byTime[2]->best_time }}</div>
        </div>
      </div>
      @endif

      {{-- tombol lihat semua --}}
      <div class="expand-wrap">
        <button class="expand-btn" onclick="toggleTable('time-table', this)">
          <span>Lihat Semua </span>
          <svg class="expand-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <small class="expand-note">{{ $byTime->count() }} data tercatat</small>
      </div>

      {{-- tabel lengkap --}}
      <div id="time-table" class="expandable-table" style="display:none;">
        <div class="lb-table-wrap">
          <table class="lb-table">
            <thead>
              <tr>
                <th>POS</th><th>DRIVER</th><th>BEST LAP</th><th>PTS</th>
              </tr>
            </thead>
            <tbody>
              @forelse($byTime as $i => $row)
              <tr class="{{ Auth::check() && $row->user_id === Auth::user()->id_user ? 'row-me' : '' }}">
                <td>
                  <span class="pos-badge {{ $i===0?'pos-gold':($i===1?'pos-silver':($i===2?'pos-bronze':'')) }}">{{ $i+1 }}</span>
                </td>
                <td>
                  <div class="driver-cell">
                    <div class="avatar-sm">{{ strtoupper(substr($row->user->username, 0, 2)) }}</div>
                    <span>{{ $row->user->username }}</span>
                  </div>
                </td>
                <td><strong>{{ $row->best_time }}</strong></td>
                <td class="muted">{{ number_format($row->score) }}</td>
              </tr>
              @empty
              <tr><td colspan="4" class="empty-td">Belum ada catatan waktu.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</section>

<script>
function switchTab(tab, el) {
  document.getElementById('tab-points').style.display = tab==='points' ? 'block' : 'none';
  document.getElementById('tab-time').style.display   = tab==='time'   ? 'block' : 'none';
  document.querySelectorAll('.lb-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
}

function toggleTable(id, btn) {
  var el = document.getElementById(id);
  var arrow = btn.querySelector('.expand-arrow');
  var label = btn.querySelector('span');
  if (el.style.display === 'none') {
    el.style.display = 'block';
    arrow.style.transform = 'rotate(180deg)';
    label.textContent = 'Tutup Tabel';
    setTimeout(function(){ el.scrollIntoView({ behavior:'smooth', block:'start' }); }, 80);
  } else {
    el.style.display = 'none';
    arrow.style.transform = '';
    label.textContent = 'Lihat Semua';
  }
}
</script>

@endsection