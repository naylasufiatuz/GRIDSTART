@extends('app')

@section('content')

<section class="leaderboard-section">
  <div class="leaderboard-container">

    <!-- HEADER -->
    <div class="lb-header">
      <p class="lb-sub">GRIDSTART CHAMPIONSHIP</p>
      <h1 class="lb-title">Driver Standings</h1>
      <p class="lb-desc">All-time leaderboard — siapa yang paling jago?</p>
    </div>

    <!-- TABS -->
    <div class="lb-tabs">
      <button class="lb-tab active" onclick="switchTab('points', this)">Points</button>
      <button class="lb-tab" onclick="switchTab('time', this)">Fastest Lap</button>
    </div>

    <!-- POINTS TAB -->
    <div id="tab-points">

      {{-- PODIUM --}}
      @if($byPoints->count() >= 3)
      <div class="lb-podium">
        {{-- P2 --}}
        <div class="podium-card p2">
          <div class="podium-pos">P2</div>
          <div class="podium-avatar">{{ strtoupper(substr($byPoints[1]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byPoints[1]->user->username }}</div>
          <div class="podium-score">{{ number_format($byPoints[1]->score) }}</div>
          @if($byPoints[1]->best_time)
          <div class="podium-time">{{ $byPoints[1]->best_time }}</div>
          @endif
        </div>
        {{-- P1 --}}
        <div class="podium-card p1">
          <div class="podium-pos">P1</div>
          <div class="podium-crown"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l3-10 4 6 4-6 3 10H3z"/><path d="M7 14h10"/></svg></div>
          <div class="podium-avatar gold">{{ strtoupper(substr($byPoints[0]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byPoints[0]->user->username }}</div>
          <div class="podium-score">{{ number_format($byPoints[0]->score) }}</div>
          @if($byPoints[0]->best_time)
          <div class="podium-time">{{ $byPoints[0]->best_time }}</div>
          @endif
        </div>
        {{-- P3 --}}
        <div class="podium-card p3">
          <div class="podium-pos">P3</div>
          <div class="podium-avatar bronze">{{ strtoupper(substr($byPoints[2]->user->username, 0, 2)) }}</div>
          <div class="podium-name">{{ $byPoints[2]->user->username }}</div>
          <div class="podium-score">{{ number_format($byPoints[2]->score) }}</div>
          @if($byPoints[2]->best_time)
          <div class="podium-time">{{ $byPoints[2]->best_time }}</div>
          @endif
        </div>
      </div>
      @endif

      {{-- TABLE --}}
      <div class="lb-table-wrap">
        <table class="lb-table">
          <thead>
            <tr>
              <th>POS</th>
              <th>DRIVER</th>
              <th>PTS</th>
              <th>BEST LAP</th>
              <th>GAP</th>
            </tr>
          </thead>
          <tbody>
            @forelse($byPoints as $i => $row)
            <tr class="{{ $i < 3 ? 'top-three' : '' }}">
              <td>
                <span class="pos-badge {{ $i === 0 ? 'pos-gold' : ($i === 1 ? 'pos-silver' : ($i === 2 ? 'pos-bronze' : '')) }}">
                  {{ $i + 1 }}
                </span>
              </td>
              <td>
                <div class="driver-cell">
                  <div class="avatar-sm">{{ strtoupper(substr($row->user->username, 0, 2)) }}</div>
                  <span>{{ $row->user->username }}</span>
                </div>
              </td>
              <td><strong>{{ number_format($row->score) }}</strong></td>
              <td class="muted">{{ $row->best_time ?? '—' }}</td>
              <td class="muted">
                @if($i === 0) — @else +{{ number_format($byPoints[0]->score - $row->score) }} @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" style="text-align: center; padding: 40px; color: #a0aec0; font-style: italic;">
                Belum ada skor tercatat. Jadilah yang pertama dengan bermain di <a href="/simulasi" style="color: #ffaa00; text-decoration: underline; font-weight: bold;">Simulasi</a>!
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- TIME TAB -->
    <div id="tab-time" style="display:none;">

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

      <div class="lb-table-wrap">
        <table class="lb-table">
          <thead>
            <tr>
              <th>POS</th>
              <th>DRIVER</th>
              <th>BEST LAP</th>
              <th>PTS</th>
            </tr>
          </thead>
          <tbody>
            @forelse($byTime as $i => $row)
            <tr>
              <td>
                <span class="pos-badge {{ $i === 0 ? 'pos-gold' : ($i === 1 ? 'pos-silver' : ($i === 2 ? 'pos-bronze' : '')) }}">
                  {{ $i + 1 }}
                </span>
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
            <tr>
              <td colspan="4" style="text-align: center; padding: 40px; color: #a0aec0; font-style: italic;">
                Belum ada catatan waktu. Jadilah yang pertama dengan bermain di <a href="/simulasi" style="color: #ffaa00; text-decoration: underline; font-weight: bold;">Simulasi</a>!
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</section>

<script>
function switchTab(tab, el) {
  document.getElementById('tab-points').style.display = tab === 'points' ? 'block' : 'none';
  document.getElementById('tab-time').style.display   = tab === 'time'   ? 'block' : 'none';
  document.querySelectorAll('.lb-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
}
</script>

@endsection