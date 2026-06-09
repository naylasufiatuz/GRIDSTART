const CSRF = document.querySelector('meta[name="csrf-token"]').content;
const BASE = '/api/admin';

// ─── NAV ───
function showSection(name) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  
  const section = document.getElementById('section-' + name);
  if (section) section.classList.add('active');

  const navItems = document.querySelectorAll('.nav-item');
  navItems.forEach(n => {
    if (n.getAttribute('onclick') && n.getAttribute('onclick').includes(`'${name}'`)) {
      n.classList.add('active');
    }
  });

  if (name === 'overview') loadOverview();
  if (name === 'users') loadUsers();
  if (name === 'scores') loadScores();
  if (name === 'pesan') loadPesans();
  if (name === 'quizzes') loadQuizzes();
}

// ─── TOAST ───
function toast(msg, type = 'success') {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = `toast ${type} show`;
  setTimeout(() => t.classList.remove('show'), 3000);
}

// ─── MODAL ───
function openModal(id) { document.getElementById(id).classList.add('open'); }
// Simple helper to close modal and reset modal specific values if needed
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

// ─── OVERVIEW (STATS & ACTIVITY) ───
async function loadOverview() {
  const statUsers = document.getElementById('stat-total-users');
  const statScores = document.getElementById('stat-total-scores');
  const statTop = document.getElementById('stat-top-score');
  const statPesans = document.getElementById('stat-total-pesans');
  
  const infoUsers = document.getElementById('info-total-users');
  const infoScores = document.getElementById('info-total-scores');
  const infoTop = document.getElementById('info-top-score');
  const infoPesans = document.getElementById('info-total-pesans');

  const activityList = document.getElementById('activity-list');

  // Load Stats
  try {
    const res = await fetch(BASE + '/dashboard/stats', {
      headers: { 'Accept': 'application/json' }
    });
    const json = await res.json();
    if (res.ok && json.data) {
      statUsers.textContent = json.data.totalUsers;
      statScores.textContent = json.data.totalGameScores;
      statTop.textContent = json.data.topScore;
      statPesans.textContent = json.data.totalPesans;

      infoUsers.textContent = json.data.totalUsers;
      infoScores.textContent = json.data.totalGameScores;
      infoTop.textContent = json.data.topScore;
      infoPesans.textContent = json.data.totalPesans;
    } else {
      console.error('Failed to load stats', json);
    }
  } catch (err) {
    console.error('Network error loading stats', err);
  }

  // Load Activities
  try {
    const res = await fetch(BASE + '/dashboard/activity', {
      headers: { 'Accept': 'application/json' }
    });
    const json = await res.json();
    if (res.ok && json.data) {
      const { recentUsers, recentScores, recentPesans } = json.data;
      if (!recentUsers.length && !recentScores.length && !recentPesans.length) {
        activityList.innerHTML = '<li>Belum ada aktivitas terbaru.</li>';
        return;
      }

      let html = '';
      recentUsers.forEach(u => {
        html += `
          <li style="padding: 10px; background: var(--bg-hover); border-radius: 6px; border-left: 4px solid #3b82f6; margin-bottom: 12px;">
            <strong style="color: #3b82f6;">User Baru</strong>: ${escapeHtml(u.username)} mendaftar (${u.created_at})
          </li>
        `;
      });
      recentScores.forEach(s => {
        html += `
          <li style="padding: 10px; background: var(--bg-hover); border-radius: 6px; border-left: 4px solid #10b981; margin-bottom: 12px;">
            <strong style="color: #10b981;">Skor Baru</strong>: ${escapeHtml(s.username)} mendapat skor ${s.score} (${s.created_at})
          </li>
        `;
      });
      recentPesans.forEach(p => {
        html += `
          <li style="padding: 10px; background: var(--bg-hover); border-radius: 6px; border-left: 4px solid #f59e0b; margin-bottom: 12px;">
            <strong style="color: #f59e0b;">Pesan Baru</strong>: Dari ${escapeHtml(p.name)} (${p.created_at})
          </li>
        `;
      });
      activityList.innerHTML = html;
    } else {
      activityList.innerHTML = '<li>Gagal memuat aktivitas.</li>';
    }
  } catch (err) {
    console.error('Network error loading activity', err);
    activityList.innerHTML = '<li>Gagal menghubungkan ke server.</li>';
  }
}

// ─── USERS ───
async function loadUsers() {
  const tbody = document.getElementById('users-tbody');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="7">Loading...</td></tr>';

  const master = document.getElementById('user-select-all');
  if (master) master.checked = false;
  updateBulkDeleteBtn('users');

  try {
    const res  = await fetch(BASE + '/users', {
      headers: { 'Accept': 'application/json' }
    });
    const json = await res.json();

    if (!json.data.length) {
      tbody.innerHTML = '<tr class="loading-row"><td colspan="7">Tidak ada data.</td></tr>';
      return;
    }

    tbody.innerHTML = json.data.map(u => `
      <tr>
        <td style="text-align: center;"><input type="checkbox" class="user-checkbox" value="${u.id_user}" onchange="updateBulkDeleteBtn('users')"/></td>
        <td><span class="badge">#${u.id_user}</span></td>
        <td>${escapeHtml(u.username)}</td>
        <td>${escapeHtml(u.email)}</td>
        <td><strong style="color: var(--accent);">${u.point} pts</strong></td>
        <td>${u.created_at ? u.created_at.substring(0,10) : '-'}</td>
        <td>
          <div class="action-btns">
            <button class="btn-edit" onclick="editUser(${u.id_user}, '${escapeJs(u.username)}', '${escapeJs(u.email)}', ${u.point || 0})">Edit</button>
            <button class="btn-del"  onclick="deleteUser(${u.id_user})">Hapus</button>
          </div>
        </td>
      </tr>
    `).join('');
  } catch (err) {
    tbody.innerHTML = '<tr class="loading-row"><td colspan="7">Gagal mengambil data user.</td></tr>';
  }
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
    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
  });
  const json = await res.json();
  toast(json.message, res.ok ? 'success' : 'error');
  if (res.ok) loadUsers();
}

// ─── SCORES ───
async function loadScores() {
  const tbody = document.getElementById('scores-tbody');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="7">Loading...</td></tr>';

  const master = document.getElementById('score-select-all');
  if (master) master.checked = false;
  updateBulkDeleteBtn('scores');

  try {
    const res  = await fetch(BASE + '/game-scores', {
      headers: { 'Accept': 'application/json' }
    });
    const json = await res.json();

    if (!json.data.length) {
      tbody.innerHTML = '<tr class="loading-row"><td colspan="7">Tidak ada data.</td></tr>';
      return;
    }

    tbody.innerHTML = json.data.map(s => `
      <tr>
        <td style="text-align: center;"><input type="checkbox" class="score-checkbox" value="${s.id}" onchange="updateBulkDeleteBtn('scores')"/></td>
        <td><span class="badge">#${s.id}</span></td>
        <td>${escapeHtml(s.username)}</td>
        <td><strong style="color:var(--accent)">${s.score}</strong></td>
        <td>${s.best_time ?? '-'}</td>
        <td>${s.created_at ? s.created_at.substring(0,10) : '-'}</td>
        <td>
          <div class="action-btns">
            <button class="btn-edit" onclick="editScore(${s.id}, ${s.score}, '${escapeJs(s.best_time ?? '')}')">Edit</button>
            <button class="btn-del"  onclick="deleteScore(${s.id})">Hapus</button>
          </div>
        </td>
      </tr>
    `).join('');
  } catch (err) {
    tbody.innerHTML = '<tr class="loading-row"><td colspan="7">Gagal mengambil data score.</td></tr>';
  }
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

// ─── PESAN (MESSAGES) ───
async function loadPesans() {
  const tbody = document.getElementById('pesan-tbody');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="9">Loading...</td></tr>';

  const master = document.getElementById('pesan-select-all');
  if (master) master.checked = false;
  updateBulkDeleteBtn('pesan');

  try {
    const res  = await fetch(BASE + '/pesan', {
      headers: { 'Accept': 'application/json' }
    });
    const json = await res.json();

    if (!json.data.length) {
      tbody.innerHTML = '<tr class="loading-row"><td colspan="9">Tidak ada data.</td></tr>';
      return;
    }

    tbody.innerHTML = json.data.map(p => `
      <tr>
        <td style="text-align: center;"><input type="checkbox" class="pesan-checkbox" value="${p.id}" onchange="updateBulkDeleteBtn('pesan')"/></td>
        <td><span class="badge">#${p.id}</span></td>
        <td>${escapeHtml(p.name)}</td>
        <td>${escapeHtml(p.email)}</td>
        <td>${escapeHtml(p.phone ?? '-')}</td>
        <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${escapeHtml(p.message ?? '')}">${escapeHtml(p.message ?? '')}</td>
        <td>
          <span class="badge" style="background-color: ${p.agree ? '#10b981' : '#ef4444'}; color: #fff; padding: 2px 6px; border-radius: 4px; font-size: 0.75rem;">
            ${p.agree ? 'Ya' : 'Tidak'}
          </span>
        </td>
        <td>${p.created_at ? p.created_at.substring(0,10) : '-'}</td>
        <td>
          <div class="action-btns">
            <button class="btn-del"  onclick="deletePesan(${p.id})">Hapus</button>
          </div>
        </td>
      </tr>
    `).join('');
  } catch (err) {
    tbody.innerHTML = '<tr class="loading-row"><td colspan="9">Gagal mengambil data pesan.</td></tr>';
  }
}

async function deletePesan(id) {
  if (!confirm('Hapus pesan ini?')) return;
  const res  = await fetch(`${BASE}/pesan/${id}`, {
    method: 'DELETE',
    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
  });
  const json = await res.json();
  toast(json.message, res.ok ? 'success' : 'error');
  if (res.ok) loadPesans();
}

// ─── QUIZZES ───
function toggleObstacleTypeSelect() {
  const type = document.getElementById('quiz-type').value;
  const group = document.getElementById('obstacle-type-group');
  if (type === 'pitstop') {
    group.style.display = 'none';
  } else {
    group.style.display = 'block';
  }
}

async function loadQuizzes() {
  const tbody = document.getElementById('quizzes-tbody');
  tbody.innerHTML = '<tr class="loading-row"><td colspan="8">Loading...</td></tr>';

  const master = document.getElementById('quiz-select-all');
  if (master) master.checked = false;
  updateBulkDeleteBtn('quizzes');

  try {
    const res  = await fetch(BASE + '/quizzes', {
      headers: { 'Accept': 'application/json' }
    });
    const json = await res.json();

    if (!json.data.length) {
      tbody.innerHTML = '<tr class="loading-row"><td colspan="8">Tidak ada data.</td></tr>';
      return;
    }

    tbody.innerHTML = json.data.map(q => {
      const typeBadge = q.quiz_type === 'pitstop' 
        ? '<span class="badge" style="background-color:#10b981;color:#fff;padding:2px 6px;border-radius:4px;font-size:0.75rem;">Pit Stop</span>' 
        : '<span class="badge" style="background-color:#3b82f6;color:#fff;padding:2px 6px;border-radius:4px;font-size:0.75rem;">Obstacle</span>';
      
      const triggerName = q.quiz_type === 'pitstop' 
        ? '-' 
        : (q.obstacle_type === 'yellow_flag' ? 'Yellow Flag (200m)' : (q.obstacle_type === 'racing_line' ? 'Racing Line (500m)' : 'Brake Zone (800m)'));

      return `
        <tr>
          <td style="text-align: center;"><input type="checkbox" class="quiz-checkbox" value="${q.id}" onchange="updateBulkDeleteBtn('quizzes')"/></td>
          <td><span class="badge">#${q.id}</span></td>
          <td>${typeBadge}</td>
          <td><strong>${triggerName}</strong></td>
          <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${escapeHtml(q.question)}">${escapeHtml(q.question)}</td>
          <td>
            A: ${escapeHtml(q.option_a)}<br>
            B: ${escapeHtml(q.option_b)}<br>
            C: ${escapeHtml(q.option_c)}<br>
            <strong>Benar: [${q.correct_answer}]</strong>
          </td>
          <td><strong style="color:var(--accent)">${q.points}</strong></td>
          <td>
            <div class="action-btns">
              <button class="btn-edit" onclick="editQuiz(${q.id}, '${q.quiz_type}', '${q.obstacle_type || ''}', \`${escapeJs(q.question)}\`, \`${escapeJs(q.option_a)}\`, \`${escapeJs(q.option_b)}\`, \`${escapeJs(q.option_c)}\`, '${q.correct_answer}', ${q.points})">Edit</button>
              <button class="btn-del"  onclick="deleteQuiz(${q.id})">Hapus</button>
            </div>
          </td>
        </tr>
      `;
    }).join('');
  } catch (err) {
    tbody.innerHTML = '<tr class="loading-row"><td colspan="8">Gagal mengambil data kuis.</td></tr>';
  }
}

function openQuizModal() {
  document.getElementById('quiz-modal-title').textContent = 'Add Quiz';
  document.getElementById('quiz-id').value = '';
  document.getElementById('quiz-type').value = 'obstacle';
  document.getElementById('quiz-obstacle-type').value = 'yellow_flag';
  document.getElementById('quiz-question-text').value = '';
  document.getElementById('quiz-opt-a').value = '';
  document.getElementById('quiz-opt-b').value = '';
  document.getElementById('quiz-opt-c').value = '';
  document.getElementById('quiz-correct-answer').value = 'A';
  document.getElementById('quiz-points').value = '10';
  toggleObstacleTypeSelect();
  openModal('quiz-modal');
}

function editQuiz(id, type, obstacle_type, question, option_a, option_b, option_c, correct_answer, points) {
  document.getElementById('quiz-modal-title').textContent = 'Edit Quiz';
  document.getElementById('quiz-id').value = id;
  document.getElementById('quiz-type').value = type;
  document.getElementById('quiz-obstacle-type').value = obstacle_type || 'yellow_flag';
  document.getElementById('quiz-question-text').value = question;
  document.getElementById('quiz-opt-a').value = option_a;
  document.getElementById('quiz-opt-b').value = option_b;
  document.getElementById('quiz-opt-c').value = option_c;
  document.getElementById('quiz-correct-answer').value = correct_answer;
  document.getElementById('quiz-points').value = points;
  toggleObstacleTypeSelect();
  openModal('quiz-modal');
}

async function saveQuiz() {
  const id             = document.getElementById('quiz-id').value;
  const quiz_type      = document.getElementById('quiz-type').value;
  const obstacle_type  = quiz_type === 'pitstop' ? null : document.getElementById('quiz-obstacle-type').value;
  const question       = document.getElementById('quiz-question-text').value;
  const option_a       = document.getElementById('quiz-opt-a').value;
  const option_b       = document.getElementById('quiz-opt-b').value;
  const option_c       = document.getElementById('quiz-opt-c').value;
  const correct_answer = document.getElementById('quiz-correct-answer').value;
  const points         = document.getElementById('quiz-points').value;

  const body = { quiz_type, obstacle_type, question, option_a, option_b, option_c, correct_answer, points };
  const method = id ? 'PUT' : 'POST';
  const url    = id ? `${BASE}/quizzes/${id}` : `${BASE}/quizzes`;

  const res = await fetch(url, {
    method,
    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
    body: JSON.stringify(body),
  });

  const json = await res.json();
  if (res.ok) {
    toast(json.message);
    closeModal('quiz-modal');
    loadQuizzes();
  } else {
    toast(Object.values(json.errors || {}).flat().join(' ') || json.message, 'error');
  }
}

async function deleteQuiz(id) {
  if (!confirm('Hapus kuis ini?')) return;
  const res  = await fetch(`${BASE}/quizzes/${id}`, {
    method: 'DELETE',
    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
  });
  const json = await res.json();
  toast(json.message, res.ok ? 'success' : 'error');
  if (res.ok) loadQuizzes();
}

// ─── BULK OPERATIONS ───
function toggleSelectAll(master, type) {
  const checkboxes = document.querySelectorAll(`.${type}-checkbox`);
  checkboxes.forEach(cb => cb.checked = master.checked);
  
  const pluralType = type === 'user' ? 'users' : 
                     (type === 'score' ? 'scores' : 
                     (type === 'pesan' ? 'pesan' : 'quizzes'));
  updateBulkDeleteBtn(pluralType);
}

function updateBulkDeleteBtn(type) {
  const cbClass = type === 'users' ? 'user-checkbox' : 
                  (type === 'scores' ? 'score-checkbox' : 
                  (type === 'pesan' ? 'pesan-checkbox' : 'quiz-checkbox'));
  const btnId = `btn-bulk-delete-${type}`;
  
  const checkedCount = document.querySelectorAll(`.${cbClass}:checked`).length;
  const btn = document.getElementById(btnId);
  if (btn) {
    btn.style.display = checkedCount > 0 ? 'inline-block' : 'none';
  }
}

async function bulkDelete(type) {
  const cbClass = type === 'users' ? 'user-checkbox' : 
                  (type === 'scores' ? 'score-checkbox' : 
                  (type === 'pesan' ? 'pesan-checkbox' : 'quiz-checkbox'));
  const selectedCbs = document.querySelectorAll(`.${cbClass}:checked`);
  const ids = Array.from(selectedCbs).map(cb => cb.value);

  if (!ids.length) return;
  if (!confirm(`Hapus ${ids.length} data terpilih secara permanen?`)) return;

  let endpoint = '';
  if (type === 'users') endpoint = '/users';
  else if (type === 'scores') endpoint = '/game-scores';
  else if (type === 'pesan') endpoint = '/pesan';
  else if (type === 'quizzes') endpoint = '/quizzes';

  let successCount = 0;
  let failCount = 0;

  for (const id of ids) {
    try {
      const res = await fetch(`${BASE}${endpoint}/${id}`, {
        method: 'DELETE',
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF }
      });
      if (res.ok) successCount++;
      else failCount++;
    } catch (e) {
      failCount++;
    }
  }

  if (successCount > 0) {
    toast(`Berhasil menghapus ${successCount} data.`);
  }
  if (failCount > 0) {
    toast(`Gagal menghapus ${failCount} data.`, 'error');
  }

  const masterId = type === 'users' ? 'user-select-all' : 
                   (type === 'scores' ? 'score-select-all' : 
                   (type === 'pesan' ? 'pesan-select-all' : 'quiz-select-all'));
  const master = document.getElementById(masterId);
  if (master) master.checked = false;

  if (type === 'users') loadUsers();
  else if (type === 'scores') loadScores();
  else if (type === 'pesan') loadPesans();
  else if (type === 'quizzes') loadQuizzes();
}

// ─── UTILITIES ───
function escapeHtml(text) {
  if (!text) return '';
  return String(text)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

function escapeJs(text) {
  if (!text) return '';
  return String(text)
    .replace(/\\/g, '\\\\')
    .replace(/'/g, "\\'")
    .replace(/"/g, '\\"')
    .replace(/\n/g, '\\n')
    .replace(/\r/g, '\\r');
}

// ─── INITIALIZATION ───
document.addEventListener('DOMContentLoaded', () => {
  showSection('overview');
});
