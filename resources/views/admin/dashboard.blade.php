<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard — GridStart Admin</title>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <p class="label">GridStart</p>
    <h2>Admin Panel</h2>
  </div>

  <div class="nav-section">
    <p class="nav-label">Menu</p>
    <button class="nav-item active" onclick="showSection('overview')">
      <span class="icon">◈</span> Overview
    </button>
    <button class="nav-item" onclick="showSection('users')">
      <span class="icon">◉</span> Users
    </button>
    <button class="nav-item" onclick="showSection('scores')">
      <span class="icon">◐</span> Game Scores
    </button>
  </div>

  <div class="sidebar-footer">
    <p class="admin-tag">Logged in as<br><strong style="color:var(--accent)">{{ session('admin_username') }}</strong></p>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="logout-btn">⏏ Logout</button>
    </form>
  </div>
</aside>

<!-- MAIN -->
<main class="main">

  <!-- OVERVIEW -->
  <div class="section active" id="section-overview">
    <div class="page-header">
      <h1>Dashboard</h1>
      <p>{{ now()->format('l, d M Y') }}</p>
    </div>

    <div class="stats">
      <div class="stat-card">
        <p class="stat-label">Total Users</p>
        <p class="stat-value">{{ $totalUsers }}</p>
      </div>
      <div class="stat-card">
        <p class="stat-label">Total Game Scores</p>
        <p class="stat-value">{{ $totalGameScores }}</p>
      </div>
      <div class="stat-card">
        <p class="stat-label">Top Score</p>
        <p class="stat-value">{{ $topScore }}</p>
      </div>
    </div>
  </div>

  <!-- USERS -->
  <div class="section" id="section-users">
    <div class="page-header">
      <h1>Users</h1>
      <p>Manage registered users</p>
    </div>
    <div class="section-header">
      <h2>All Users</h2>
      <button class="btn-add" onclick="openUserModal()">+ Add User</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
<th>ID</th><th>Username</th><th>Email</th><th>Joined</th><th>Action</th>
          </tr>
        </thead>
        <tbody id="users-tbody">
          <tr class="loading-row"><td colspan="6">Loading...</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- GAME SCORES -->
  <div class="section" id="section-scores">
    <div class="page-header">
      <h1>Game Scores</h1>
      <p>Manage game score records</p>
    </div>
    <div class="section-header">
      <h2>All Scores</h2>
      <button class="btn-add" onclick="openScoreModal()">+ Add Score</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>ID</th><th>Username</th><th>Score</th><th>Best Time</th><th>Date</th><th>Action</th>
          </tr>
        </thead>
        <tbody id="scores-tbody">
          <tr class="loading-row"><td colspan="6">Loading...</td></tr>
        </tbody>
      </table>
    </div>
  </div>

</main>

<!-- MODAL USER -->
<div class="modal-overlay" id="user-modal">
  <div class="modal">
    <h3 id="user-modal-title">Add User</h3>
    <input type="hidden" id="user-id"/>
    <div class="form-group">
      <label>Username</label>
      <input type="text" id="user-username" placeholder="username"/>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" id="user-email" placeholder="email@example.com"/>
    </div>
    <div class="form-group">
      <label>Password <span style="color:var(--muted)">(kosongkan jika tidak ingin ganti)</span></label>
      <input type="password" id="user-password" placeholder="••••••"/>
    </div>
    <div class="form-group">
      <label>Point</label>
      <input type="number" id="user-point" placeholder="0"/>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('user-modal')">Batal</button>
      <button class="btn-save" onclick="saveUser()">Simpan</button>
    </div>
  </div>
</div>

<!-- MODAL SCORE -->
<div class="modal-overlay" id="score-modal">
  <div class="modal">
    <h3 id="score-modal-title">Add Score</h3>
    <input type="hidden" id="score-id"/>
    <div class="form-group">
      <label>ID User</label>
      <input type="number" id="score-id-user" placeholder="id_user"/>
    </div>
    <div class="form-group">
      <label>Score</label>
      <input type="number" id="score-score" placeholder="0"/>
    </div>
    <div class="form-group">
      <label>Best Time</label>
      <input type="text" id="score-best-time" placeholder="00:00"/>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('score-modal')">Batal</button>
      <button class="btn-save" onclick="saveScore()">Simpan</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>