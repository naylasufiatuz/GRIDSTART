<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard — GridStart Admin</title>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #050505;
      --surface: #18181b;
      --surface2: #1f1f23;
      --border: #2a2a2e;
      --accent: #e8e0d4;
      --accent2: #c8ddd9;
      --text: #f0f0f0;
      --muted: #555;
      --danger: #ff4d4d;
      --success: #4dff91;
      --warning: #ffd166;
      --sidebar-w: 220px;
    }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      display: flex;
      min-height: 100vh;
    }

    /* ── SIDEBAR ── */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--surface);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      padding: 28px 0;
      position: fixed;
      height: 100vh;
      top: 0; left: 0;
    }

    .sidebar-brand {
      padding: 0 24px 28px;
      border-bottom: 1px solid var(--border);
    }

    .sidebar-brand .label {
      font-family: 'DM Mono', monospace;
      font-size: 9px;
      letter-spacing: 0.25em;
      color: var(--muted);
      text-transform: uppercase;
      margin-bottom: 4px;
    }

    .sidebar-brand h2 {
      font-size: 16px;
      font-weight: 700;
      color: var(--accent);
    }

    .nav-section {
      padding: 20px 16px 8px;
    }

    .nav-label {
      font-family: 'DM Mono', monospace;
      font-size: 9px;
      letter-spacing: 0.2em;
      color: var(--muted);
      text-transform: uppercase;
      padding: 0 8px;
      margin-bottom: 6px;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 10px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 13px;
      font-weight: 500;
      color: #888;
      transition: all 0.15s;
      margin-bottom: 2px;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
    }

    .nav-item:hover { background: var(--surface2); color: var(--text); }
    .nav-item.active { background: var(--surface2); color: var(--accent); }

    .nav-item .icon { font-size: 15px; }

    .sidebar-footer {
      margin-top: auto;
      padding: 20px 16px 0;
      border-top: 1px solid var(--border);
    }

    .admin-tag {
      font-family: 'DM Mono', monospace;
      font-size: 10px;
      color: var(--muted);
      padding: 0 8px;
      margin-bottom: 10px;
    }

    .logout-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 9px 10px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 13px;
      color: var(--danger);
      background: none;
      border: none;
      width: 100%;
      text-align: left;
      transition: background 0.15s;
    }

    .logout-btn:hover { background: rgba(255,77,77,0.08); }

    /* ── MAIN ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      padding: 32px 36px;
      min-height: 100vh;
    }

    .page-header {
      margin-bottom: 28px;
    }

    .page-header h1 {
      font-size: 22px;
      font-weight: 700;
      color: var(--accent);
      margin-bottom: 4px;
    }

    .page-header p {
      font-size: 13px;
      color: var(--muted);
      font-family: 'DM Mono', monospace;
    }

    /* ── STAT CARDS ── */
    .stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin-bottom: 32px;
    }

    .stat-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 20px 22px;
    }

    .stat-label {
      font-family: 'DM Mono', monospace;
      font-size: 10px;
      letter-spacing: 0.15em;
      color: var(--muted);
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .stat-value {
      font-size: 28px;
      font-weight: 700;
      color: var(--accent);
    }

    /* ── SECTION ── */
    .section { display: none; }
    .section.active { display: block; }

    .section-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 18px;
    }

    .section-header h2 {
      font-size: 16px;
      font-weight: 700;
      color: var(--text);
    }

    .btn-add {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      background: var(--accent2);
      color: #0e0e0f;
      border: none;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 700;
      font-family: 'DM Mono', monospace;
      letter-spacing: 0.08em;
      cursor: pointer;
      transition: opacity 0.2s;
    }

    .btn-add:hover { opacity: 0.8; }

    /* ── TABLE ── */
    .table-wrap {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead tr {
      border-bottom: 1px solid var(--border);
    }

    th {
      padding: 12px 16px;
      text-align: left;
      font-family: 'DM Mono', monospace;
      font-size: 10px;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--muted);
      font-weight: 500;
    }

    td {
      padding: 13px 16px;
      font-size: 13px;
      color: #ccc;
      border-bottom: 1px solid var(--border);
    }

    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: var(--surface2); }

    .badge {
      display: inline-block;
      padding: 2px 8px;
      border-radius: 20px;
      font-size: 11px;
      font-family: 'DM Mono', monospace;
      background: rgba(200,221,217,0.12);
      color: var(--accent2);
    }

    .action-btns {
      display: flex;
      gap: 6px;
    }

    .btn-edit, .btn-del {
      padding: 5px 10px;
      border-radius: 6px;
      border: none;
      font-size: 11px;
      font-family: 'DM Mono', monospace;
      cursor: pointer;
      transition: opacity 0.2s;
    }

    .btn-edit { background: rgba(232,224,212,0.12); color: var(--accent); }
    .btn-del  { background: rgba(255,77,77,0.1);   color: var(--danger); }
    .btn-edit:hover, .btn-del:hover { opacity: 0.7; }

    .loading-row td { text-align: center; color: var(--muted); padding: 28px; font-family: 'DM Mono', monospace; font-size: 12px; }

    /* ── MODAL ── */
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.7);
      z-index: 100;
      align-items: center;
      justify-content: center;
    }

    .modal-overlay.open { display: flex; }

    .modal {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 28px;
      width: 100%;
      max-width: 420px;
    }

    .modal h3 {
      font-size: 16px;
      font-weight: 700;
      color: var(--accent);
      margin-bottom: 20px;
    }

    .modal .form-group { margin-bottom: 14px; }

    .modal label {
      display: block;
      font-family: 'DM Mono', monospace;
      font-size: 10px;
      letter-spacing: 0.12em;
      color: var(--muted);
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .modal input {
      width: 100%;
      padding: 10px 12px;
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 8px;
      color: var(--text);
      font-size: 13px;
      font-family: 'DM Sans', sans-serif;
      outline: none;
    }

    .modal input:focus { border-color: var(--accent2); }

    .modal-footer {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }

    .btn-save {
      flex: 1;
      padding: 11px;
      background: var(--accent);
      color: #0e0e0f;
      border: none;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 700;
      font-family: 'DM Mono', monospace;
      letter-spacing: 0.08em;
      cursor: pointer;
    }

    .btn-cancel {
      flex: 1;
      padding: 11px;
      background: var(--surface2);
      color: var(--muted);
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 12px;
      font-family: 'DM Mono', monospace;
      cursor: pointer;
    }

    .toast {
      position: fixed;
      bottom: 24px;
      right: 24px;
      padding: 12px 18px;
      border-radius: 10px;
      font-size: 13px;
      font-family: 'DM Mono', monospace;
      z-index: 999;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s;
      pointer-events: none;
    }

    .toast.show { opacity: 1; transform: translateY(0); }
    .toast.success { background: rgba(77,255,145,0.15); border: 1px solid rgba(77,255,145,0.3); color: var(--success); }
    .toast.error   { background: rgba(255,77,77,0.15);  border: 1px solid rgba(255,77,77,0.3);  color: var(--danger); }
  </style>
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

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;
const BASE = '/api/admin';

// ── NAV ──
function showSection(name) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  document.getElementById('section-' + name).classList.add('active');
  event.currentTarget.classList.add('active');

  if (name === 'users') loadUsers();
  if (name === 'scores') loadScores();
}

// ── TOAST ──
function toast(msg, type = 'success') {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = `toast ${type} show`;
  setTimeout(() => t.classList.remove('show'), 3000);
}

// ── MODAL ──
function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

// ══════════════════
// USERS
// ══════════════════
async function loadUsers() {
  const tbody = document.getElementById('users-tbody');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="6">Loading...</td></tr>';

const res  = await fetch(BASE + '/users');
  const json = await res.json();

  if (!json.data.length) {
    tbody.innerHTML = '<tr class="loading-row"><td colspan="6">Tidak ada data.</td></tr>';
    return;
  }

  tbody.innerHTML = json.data.map(u => `
    <tr>
      <td><span class="badge">#${u.id_user}</span></td>
      <td>${u.username}</td>
      <td>${u.email}</td>
      <td>${u.created_at ? u.created_at.substring(0,10) : '-'}</td>
      <td>
        <div class="action-btns">
          <button class="btn-edit" onclick="editUser(${u.id_user},'${u.username}','${u.email}',${u.point})">Edit</button>
          <button class="btn-del"  onclick="deleteUser(${u.id_user})">Hapus</button>
        </div>
      </td>
    </tr>
  `).join('');
}

function openUserModal() {
  document.getElementById('user-modal-title').textContent = 'Add User';
  document.getElementById('user-id').value = '';
  document.getElementById('user-username').value = '';
  document.getElementById('user-email').value = '';
  document.getElementById('user-password').value = '';
  document.getElementById('user-point').value = '';
  openModal('user-modal');
}

function editUser(id, username, email, point) {
  document.getElementById('user-modal-title').textContent = 'Edit User';
  document.getElementById('user-id').value = id;
  document.getElementById('user-username').value = username;
  document.getElementById('user-email').value = email;
  document.getElementById('user-password').value = '';
  document.getElementById('user-point').value = point;
  openModal('user-modal');
}

async function saveUser() {
  const id       = document.getElementById('user-id').value;
  const username = document.getElementById('user-username').value;
  const email    = document.getElementById('user-email').value;
  const password = document.getElementById('user-password').value;
  const point    = document.getElementById('user-point').value;

  const body = { username, email, point };
  if (password) body.password = password;

  const method = id ? 'PUT' : 'POST';
  const url    = id ? `${BASE}/users/${id}` : `${BASE}/users`;

  const res = await fetch(url, {
    method,
headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
    body: JSON.stringify(body),
  });

  const json = await res.json();
  if (res.ok) {
    toast(json.message);
    closeModal('user-modal');
    loadUsers();
  } else {
    toast(Object.values(json.errors || {}).flat().join(' ') || json.message, 'error');
  }
}

async function deleteUser(id) {
  if (!confirm('Hapus user ini?')) return;
  const res  = await fetch(`${BASE}/users/${id}`, {
    method: 'DELETE',
headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },  });
  const json = await res.json();
  toast(json.message, res.ok ? 'success' : 'error');
  if (res.ok) loadUsers();
}

// ══════════════════
// SCORES
// ══════════════════
async function loadScores() {
  const tbody = document.getElementById('scores-tbody');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="6">Loading...</td></tr>';

const res  = await fetch(BASE + '/game-scores', {
  headers: { 'Accept': 'application/json' }
});  const json = await res.json();

  if (!json.data.length) {
    tbody.innerHTML = '<tr class="loading-row"><td colspan="6">Tidak ada data.</td></tr>';
    return;
  }

  tbody.innerHTML = json.data.map(s => `
    <tr>
      <td><span class="badge">#${s.id}</span></td>
      <td>${s.username}</td>
      <td><strong style="color:var(--accent)">${s.score}</strong></td>
      <td>${s.best_time ?? '-'}</td>
      <td>${s.created_at ? s.created_at.substring(0,10) : '-'}</td>
      <td>
        <div class="action-btns">
          <button class="btn-edit" onclick="editScore(${s.id},${s.score},'${s.best_time ?? ''}')">Edit</button>
          <button class="btn-del"  onclick="deleteScore(${s.id})">Hapus</button>
        </div>
      </td>
    </tr>
  `).join('');
}

function openScoreModal() {
  document.getElementById('score-modal-title').textContent = 'Add Score';
  document.getElementById('score-id').value = '';
  document.getElementById('score-id-user').value = '';
  document.getElementById('score-score').value = '';
  document.getElementById('score-best-time').value = '';
  openModal('score-modal');
}

function editScore(id, score, best_time) {
  document.getElementById('score-modal-title').textContent = 'Edit Score';
  document.getElementById('score-id').value = id;
  document.getElementById('score-id-user').value = '';
  document.getElementById('score-score').value = score;
  document.getElementById('score-best-time').value = best_time;
  openModal('score-modal');
}

async function saveScore() {
  const id        = document.getElementById('score-id').value;
  const id_user   = document.getElementById('score-id-user').value;
  const score     = document.getElementById('score-score').value;
  const best_time = document.getElementById('score-best-time').value;

  const body   = id ? { score, best_time } : { id_user, score, best_time };
  const method = id ? 'PUT' : 'POST';
  const url    = id ? `${BASE}/game-scores/${id}` : `${BASE}/game-scores`;

  const res  = await fetch(url, {
    method,
headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
    body: JSON.stringify(body),
  });

  const json = await res.json();
  if (res.ok) {
    toast(json.message);
    closeModal('score-modal');
    loadScores();
  } else {
    toast(Object.values(json.errors || {}).flat().join(' ') || json.message, 'error');
  }
}

async function deleteScore(id) {
  if (!confirm('Hapus score ini?')) return;
  const res  = await fetch(`${BASE}/game-scores/${id}`, {
    method: 'DELETE',
headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
  });
  const json = await res.json();
  toast(json.message, res.ok ? 'success' : 'error');
  if (res.ok) loadScores();
}
</script>
</body>
</html>