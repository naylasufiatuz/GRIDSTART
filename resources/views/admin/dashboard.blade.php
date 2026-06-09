<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard — GridStart Admin</title>
  <meta name="robots" content="noindex, nofollow" />
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
      <div>
        <p class="label">GridStart</p>
        <h2>Admin Panel</h2>
      </div>
      <button class="sidebar-close" onclick="document.querySelector('.sidebar').classList.remove('open')" aria-label="Close Sidebar" style="display: none; font-size: 24px; color: #fff; background: transparent; border: none; cursor: pointer; line-height: 1;">&times;</button>
    </div>
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
    <button class="nav-item" onclick="showSection('pesan')">
      <span class="icon">✉</span> Pesan
    </button>
    <button class="nav-item" onclick="showSection('quizzes')">
      <span class="icon">▩</span> Quizzes
    </button>
    <button class="nav-item" onclick="window.location.href='{{ route('app') }}'">
      <span class="icon">⌂</span> Kembali ke Aplikasi
    </button>
  </div>

  <div class="sidebar-footer">
    <p class="admin-tag">Logged in as <strong style="color:var(--accent2)">{{ auth()->user()->username }}</strong></p>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="logout-btn">⏏ Logout</button>
    </form>
  </div>
</aside>

<!-- MAIN -->
<main class="main">
  <div class="main-inner">
    <div class="topbar">
      <div class="topbar-left">
        <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <span class="topbar-icon">▦</span>
        <div>
          <p class="topbar-label">Dashboard</p>
          <h1>Admin Panel</h1>
        </div>
      </div>
    </div>

    <!-- OVERVIEW -->
    <div class="section active" id="section-overview">
      <div class="dashboard-header">
        <div>
          <p class="small-label">Dashboard Admin</p>
          <h2>Home / Dashboard</h2>
        </div>
        <p class="date-label">{{ now()->format('l, d M Y') }}</p>
      </div>
      <br>
      <div class="stats-grid">
        <div class="stat-card">
          <p class="stat-label">Total Users</p>
          <p class="stat-value" id="stat-total-users">Loading...</p>
        </div>
        <div class="stat-card">
          <p class="stat-label">Total Game Scores</p>
          <p class="stat-value" id="stat-total-scores">Loading...</p>
        </div>
        <div class="stat-card">
          <p class="stat-label">Top Score</p>
          <p class="stat-value" id="stat-top-score">Loading...</p>
        </div>
        <div class="stat-card">
          <p class="stat-label">Total Pesan</p>
          <p class="stat-value" id="stat-total-pesans">Loading...</p>
        </div>
      </div>

      <div class="activity-grid">
        <div class="activity-card">
          <div class="activity-card-header">
            <div>
              <p class="small-label">Aktivitas Terbaru</p>
              <h3>Ringkasan Aktivitas</h3>
            </div>
          </div>
          <div class="activity-body">
            <ul id="activity-list" style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
              <p>Loading recent activities...</p>
            </ul>
          </div>
        </div>
        <div class="detail-card">
          <div class="detail-card-header">
            <p class="small-label">Ringkasan</p>
            <h3>Info Cepat</h3>
          </div>
          <div class="detail-list">
            <div class="detail-item">
              <span>Total Users</span>
              <strong id="info-total-users">0</strong>
            </div>
            <div class="detail-item">
              <span>Total Game Scores</span>
              <strong id="info-total-scores">0</strong>
            </div>
            <div class="detail-item">
              <span>Top Score</span>
              <strong id="info-top-score">0</strong>
            </div>
            <div class="detail-item">
              <span>Total Pesan</span>
              <strong id="info-total-pesans">0</strong>
            </div>
          </div>
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
        <div style="display: flex; gap: 10px;">
          <button class="btn-del" id="btn-bulk-delete-users" style="display: none; padding: 10px 15px; border-radius: 5px; font-weight: 700; cursor: pointer;" onclick="bulkDelete('users')">Hapus Terpilih</button>
          <button class="btn-add" onclick="openUserModal()">+ Add User</button>
        </div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th style="width: 40px; text-align: center;"><input type="checkbox" id="user-select-all" onclick="toggleSelectAll(this, 'user')"/></th>
              <th>ID</th><th>Username</th><th>Email</th><th>Point</th><th>Joined</th><th>Action</th>
            </tr>
          </thead>
          <tbody id="users-tbody">
            <tr class="loading-row"><td colspan="7">Loading...</td></tr>
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
        <div style="display: flex; gap: 10px;">
          <button class="btn-del" id="btn-bulk-delete-scores" style="display: none; padding: 10px 15px; border-radius: 5px; font-weight: 700; cursor: pointer;" onclick="bulkDelete('scores')">Hapus Terpilih</button>
          <button class="btn-add" onclick="openScoreModal()">+ Add Score</button>
        </div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th style="width: 40px; text-align: center;"><input type="checkbox" id="score-select-all" onclick="toggleSelectAll(this, 'score')"/></th>
              <th>ID</th><th>Username</th><th>Score</th><th>Best Time</th><th>Date</th><th>Action</th>
            </tr>
          </thead>
          <tbody id="scores-tbody">
            <tr class="loading-row"><td colspan="7">Loading...</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- PESAN -->
    <div class="section" id="section-pesan">
      <div class="page-header">
        <h1>Pesan</h1>
        <p>Kelola pesan dari form kontak</p>
      </div>
      <div class="section-header">
        <h2>Semua Pesan</h2>
        <button class="btn-del" id="btn-bulk-delete-pesan" style="display: none; padding: 10px 15px; border-radius: 5px; font-weight: 700; cursor: pointer;" onclick="bulkDelete('pesan')">Hapus Terpilih</button>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th style="width: 40px; text-align: center;"><input type="checkbox" id="pesan-select-all" onclick="toggleSelectAll(this, 'pesan')"/></th>
              <th>ID</th><th>Nama</th><th>Email</th><th>No. WhatsApp</th><th style="min-width: 250px;">Pesan</th><th>Hubungi via Email</th><th>Tanggal</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody id="pesan-tbody">
            <tr class="loading-row"><td colspan="9">Loading...</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- QUIZZES -->
    <div class="section" id="section-quizzes">
      <div class="page-header">
        <h1>Quizzes</h1>
        <p>Kelola bank soal kuis simulasi mengemudi dan kuis pit stop</p>
      </div>
      <div class="section-header">
        <h2>Semua Pertanyaan Kuis</h2>
        <div style="display: flex; gap: 10px;">
          <button class="btn-del" id="btn-bulk-delete-quizzes" style="display: none; padding: 10px 15px; border-radius: 5px; font-weight: 700; cursor: pointer;" onclick="bulkDelete('quizzes')">Hapus Terpilih</button>
          <button class="btn-add" onclick="openQuizModal()">+ Add Quiz</button>
        </div>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th style="width: 40px; text-align: center;"><input type="checkbox" id="quiz-select-all" onclick="toggleSelectAll(this, 'quiz')"/></th>
              <th>ID</th><th>Tipe Kuis</th><th>Tipe Rintangan</th><th style="min-width: 250px;">Pertanyaan</th><th>Pilihan (Benar)</th><th>Points</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody id="quizzes-tbody">
            <tr class="loading-row"><td colspan="8">Loading...</td></tr>
          </tbody>
        </table>
      </div>
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

<!-- MODAL QUIZ -->
<div class="modal-overlay" id="quiz-modal">
  <div class="modal" style="max-width: 520px;">
    <h3 id="quiz-modal-title">Add Quiz</h3>
    <input type="hidden" id="quiz-id"/>
    <div class="form-group">
      <label>Quiz Type</label>
      <select id="quiz-type" onchange="toggleObstacleTypeSelect()" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid var(--border);">
        <option value="obstacle">Obstacle (Di Dalam Game)</option>
        <option value="pitstop">Pit Stop (Pengisian Bensin)</option>
      </select>
    </div>
    <div class="form-group" id="obstacle-type-group">
      <label>Trigger Category (Rintangan)</label>
      <select id="quiz-obstacle-type" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid var(--border);">
        <option value="yellow_flag">Yellow Flag (200m)</option>
        <option value="racing_line">Racing Line (500m)</option>
        <option value="brake_zone">Brake Zone (800m)</option>
      </select>
    </div>
    <div class="form-group">
      <label>Question Text</label>
      <textarea id="quiz-question-text" rows="3" placeholder="Pertanyaan kuis..." style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid var(--border); font-family: inherit;"></textarea>
    </div>
    <div class="form-group">
      <label>Pilihan A</label>
      <input type="text" id="quiz-opt-a" placeholder="Pilihan Jawaban A"/>
    </div>
    <div class="form-group">
      <label>Pilihan B</label>
      <input type="text" id="quiz-opt-b" placeholder="Pilihan Jawaban B"/>
    </div>
    <div class="form-group">
      <label>Pilihan C</label>
      <input type="text" id="quiz-opt-c" placeholder="Pilihan Jawaban C"/>
    </div>
    <div class="form-group">
      <label>Jawaban Benar</label>
      <select id="quiz-correct-answer" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid var(--border);">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
      </select>
    </div>
    <div class="form-group">
      <label>Point</label>
      <input type="number" id="quiz-points" placeholder="10" value="10"/>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('quiz-modal')">Batal</button>
      <button class="btn-save" onclick="saveQuiz()">Simpan</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>
<script src="{{ asset('js/admin.js') }}"></script>
<script>
  function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
  }
</script>
</body>
</html>