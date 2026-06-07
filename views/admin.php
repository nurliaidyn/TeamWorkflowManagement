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

        <div class="card bg-secondary bg-opacity-10 border-secondary shadow-sm">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
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
                            location.reload(); // Revert UI on failure
                        } else {
                            // Flash green to show success
                            this.style.backgroundColor = 'rgba(25, 135, 84, 0.2)';
                            setTimeout(() => this.style.backgroundColor = '', 1000);
                        }
                    });
                });
            });

            // 2. Handle Status Toggles
            document.querySelectorAll('.status-toggle-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const currentStatus = parseInt(this.getAttribute('data-current-status'));
                    const newStatus = currentStatus === 1 ? 0 : 1; // Flip the bit

                    this.disabled = true;

                    fetch('controllers/toggle_user_status.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ target_user_id: userId, new_status: newStatus })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            location.reload(); // Refresh the table to show updated badges
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