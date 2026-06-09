<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console - Project Alpha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body class="text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary bg-opacity-10 border-bottom border-secondary mb-4">
        <div class="container">
            <a class="navbar-brand fs-6 text-secondary hover-white" href="index.php?page=dashboard">
                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
            </a>
            <span class="navbar-text fw-bold text-danger"><i class="bi bi-shield-lock me-2"></i>Admin Console</span>
        </div>
    </nav>

    <div class="container pb-5">
        
        <h2 class="fw-bold mb-4">User Management</h2>

        <div class="card bg-secondary bg-opacity-10 border-secondary shadow-sm mb-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark mb-0 align-middle">
                        <thead class="border-secondary">
                            <tr>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 ps-4 border-secondary">User</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Email</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">System Role</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 pe-4 text-end border-secondary">Account Status</th>
                            </tr>
                        </thead>
                        <tbody class="border-secondary">
                            <?php foreach ($all_users as $u): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-semibold"><?= htmlspecialchars($u['full_name']) ?></div>
                                        <div class="text-secondary small">@<?= htmlspecialchars($u['nickname']) ?></div>
                                    </td>
                                    <td><span class="text-secondary small"><?= htmlspecialchars($u['email']) ?></span></td>
                                    
                                    <td>
                                        <select class="form-select form-select-sm bg-dark border-secondary text-light role-select" data-user-id="<?= $u['id'] ?>" style="width: auto;">
                                            <option value="developer" <?= $u['system_role'] === 'developer' ? 'selected' : '' ?>>Developer</option>
                                            <option value="pm" <?= $u['system_role'] === 'pm' ? 'selected' : '' ?>>Product Manager</option>
                                            <option value="admin" <?= $u['system_role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                    </td>
                                    
                                    <td class="pe-4 text-end">
                                        <?php if ($u['is_active'] == 1): ?>
                                            <button class="btn btn-outline-danger border-secondary btn-sm status-toggle-btn" data-user-id="<?= $u['id'] ?>" data-current-status="1">
                                                Deactivate
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-outline-success border-secondary btn-sm status-toggle-btn" data-user-id="<?= $u['id'] ?>" data-current-status="0">
                                                Activate
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h2 class="fw-bold mb-4 mt-5">Workspace Management</h2>

        <div class="card bg-secondary bg-opacity-10 border-secondary shadow-sm mb-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark mb-0 align-middle">
                        <thead class="border-secondary">
                            <tr>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 ps-4 border-secondary">Project Name</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Created By</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 pe-4 text-end border-secondary">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-secondary">
                            <?php foreach ($all_projects as $p): ?>
                                <tr id="proj-row-<?= $p['id'] ?>" class="<?= $p['is_active'] == 0 ? 'opacity-50' : '' ?>">
                                    <td class="ps-4">
                                        <div class="fw-semibold proj-name"><?= htmlspecialchars($p['name']) ?></div>
                                        <div class="text-secondary small proj-desc"><?= htmlspecialchars($p['description']) ?></div>
                                    </td>
                                    <td><span class="badge bg-primary bg-opacity-25 text-primary border border-primary"><?= htmlspecialchars($p['creator_name'] ?? 'System') ?></span></td>
                                    
                                    <td class="pe-4 text-end">
                                        <div class="btn-group shadow-sm">
                                            <button class="btn btn-outline-secondary border-secondary btn-sm edit-proj-btn" data-id="<?= $p['id'] ?>" title="Edit Project">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            
                                            <?php if ($p['is_active'] == 1): ?>
                                                <button class="btn btn-outline-danger border-secondary btn-sm proj-status-btn" data-id="<?= $p['id'] ?>" data-status="0" title="Deactivate">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-outline-success border-secondary btn-sm proj-status-btn" data-id="<?= $p['id'] ?>" data-status="1" title="Restore">
                                                    Restore
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> 
    <div class="modal fade" id="editProjModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary text-light shadow-lg">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold">Edit Workspace</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editProjForm">
                        <input type="hidden" id="editProjId">
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Project Name</label>
                            <input type="text" id="editProjName" class="form-control bg-dark border-secondary text-light" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Description</label>
                            <textarea id="editProjDesc" class="form-control bg-dark border-secondary text-light" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary border-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="saveProjChanges" class="btn btn-warning fw-semibold">
                        <span class="btn-text">Save Changes</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // --- USER MANAGEMENT JS ---
            
            // 1. Handle Role Changes
            document.querySelectorAll('.role-select').forEach(select => {
                select.addEventListener('change', function() {
                    const userId = this.getAttribute('data-user-id');
                    const newRole = this.value;

                    fetch('controllers/update_role.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ target_user_id: userId, new_role: newRole })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status !== 'success') {
                            alert(data.message);
                            location.reload(); 
                        } else {
                            this.style.backgroundColor = 'rgba(25, 135, 84, 0.2)';
                            setTimeout(() => this.style.backgroundColor = '', 1000);
                        }
                    });
                });
            });

            // 2. Handle Status Toggles (Users)
            document.querySelectorAll('.status-toggle-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const currentStatus = parseInt(this.getAttribute('data-current-status'));
                    const newStatus = currentStatus === 1 ? 0 : 1; 

                    this.disabled = true;

                    fetch('controllers/toggle_user_status.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ target_user_id: userId, new_status: newStatus })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            location.reload(); 
                        } else {
                            alert(data.message);
                            this.disabled = false;
                        }
                    });
                });
            });

            // --- WORKSPACE MANAGEMENT JS ---

            // 3. Open Edit Project Modal
            document.querySelectorAll('.edit-proj-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const projId = this.getAttribute('data-id');
                    const row = document.getElementById(`proj-row-${projId}`);
                    
                    document.getElementById('editProjId').value = projId;
                    document.getElementById('editProjName').value = row.querySelector('.proj-name').innerText;
                    document.getElementById('editProjDesc').value = row.querySelector('.proj-desc').innerText;
                    
                    new bootstrap.Modal(document.getElementById('editProjModal')).show();
                });
            });

            // 4. Save Edited Project
            document.getElementById('saveProjChanges').addEventListener('click', function() {
                const id = document.getElementById('editProjId').value;
                const name = document.getElementById('editProjName').value;
                const desc = document.getElementById('editProjDesc').value;
                
                const btn = this;
                const btnText = btn.querySelector('.btn-text');
                const spinner = btn.querySelector('.spinner-border');
                
                btn.disabled = true;
                btnText.classList.add('d-none');
                spinner.classList.remove('d-none');
                
                fetch('controllers/edit_project.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ project_id: id, name: name, description: desc })
                })
                .then(res => res.json())
                .then(data => {
                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    spinner.classList.add('d-none');
                    
                    if (data.status === 'success') {
                        location.reload(); 
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Network error occurred.");
                    btn.disabled = false;
                    btnText.classList.remove('d-none');
                    spinner.classList.add('d-none');
                });
            });

            // 5. Toggle Project Status (Soft Delete / Restore)
            document.querySelectorAll('.proj-status-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (this.getAttribute('data-status') === '0') {
                        if (!confirm('Are you sure you want to deactivate this workspace?')) return;
                    }

                    const projId = this.getAttribute('data-id');
                    const newStatus = this.getAttribute('data-status');

                    this.disabled = true;

                    fetch('controllers/toggle_project_status.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ project_id: projId, new_status: newStatus })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            location.reload();
                        } else {
                            alert(data.message);
                            this.disabled = false;
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>