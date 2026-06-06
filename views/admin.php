<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Admin - Project Alpha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #11111b; }
        .table-dark { --bs-table-bg: transparent; }
    </style>
</head>
<body class="text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary bg-opacity-10 border-bottom border-secondary mb-4">
        <div class="container">
            <a class="navbar-brand fs-6 text-secondary" href="dashboard.php">
                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
            </a>
            <span class="badge bg-danger bg-opacity-25 text-danger border border-danger ms-auto">Admin Access</span>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Team Management</h2>
                <p class="text-secondary m-0">Manage roles and system access.</p>
            </div>
            <button class="btn btn-success fw-semibold">
                <i class="bi bi-person-plus me-1"></i> Invite User
            </button>
        </div>

        <div class="card bg-secondary bg-opacity-10 border-secondary shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark mb-0 align-middle">
                        <thead class="border-secondary">
                            <tr>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 ps-4 border-secondary">User</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Email</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">System Role</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Status</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 pe-4 text-end border-secondary">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-secondary">
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 35px;">N</div>
                                        <span class="fw-semibold">Niko</span>
                                    </div>
                                </td>
                                <td class="text-secondary small">niko@example.com</td>
                                <td>
                                    <select class="form-select form-select-sm bg-dark text-light border-secondary" style="width: 140px;">
                                        <option value="developer">Developer</option>
                                        <option value="qa">QA Engineer</option>
                                        <option value="pm">Product Manager</option>
                                        <option value="admin" selected>Admin</option>
                                    </select>
                                </td>
                                <td><span class="badge bg-success bg-opacity-25 text-success border border-success">Active</span></td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-sm btn-outline-secondary border-secondary" disabled>Current User</button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 35px;">J</div>
                                        <span class="fw-semibold">Janar</span>
                                    </div>
                                </td>
                                <td class="text-secondary small">janar@example.com</td>
                                <td>
                                    <select class="form-select form-select-sm bg-dark text-light border-secondary" style="width: 140px;">
                                        <option value="developer" selected>Developer</option>
                                        <option value="qa">QA Engineer</option>
                                        <option value="pm">Product Manager</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </td>
                                <td><span class="badge bg-success bg-opacity-25 text-success border border-success">Active</span></td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-sm btn-outline-danger border-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>