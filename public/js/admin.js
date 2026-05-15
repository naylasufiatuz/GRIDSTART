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