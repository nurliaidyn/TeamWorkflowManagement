<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Project Alpha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #11111b; }
        .list-group-item { transition: background-color 0.2s; }
        .list-group-item:hover { background-color: rgba(255,255,255,0.05); }
    </style>
</head>
<body class="text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary bg-opacity-10 border-bottom border-secondary mb-4">
        <div class="container">
            <a class="navbar-brand fs-6 text-secondary" href="dashboard.php">
                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row g-4">
            
            <div class="col-md-4">
                <h4 class="fw-bold mb-4">Account Settings</h4>
                
                <div class="card bg-secondary bg-opacity-10 border-secondary shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 fs-3" style="width: 70px; height: 70px;">N</div>
                            <div>
                                <h5 class="fw-bold mb-0">Niko</h5>
                                <span class="badge bg-primary bg-opacity-25 text-primary border border-primary mt-1">Admin</span>
                            </div>
                        </div>

                        <form>
                            <div class="mb-3">
                                <label class="form-label text-secondary small text-uppercase fw-bold">Display Name</label>
                                <input type="text" class="form-control bg-dark border-secondary text-light" value="Niko">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-secondary small text-uppercase fw-bold">Email Address</label>
                                <input type="email" class="form-control bg-dark border-secondary text-light" value="niko@example.com">
                            </div>
                            <button class="btn btn-primary btn-sm w-100 fw-semibold">Update Profile</button>
                        </form>
                    </div>
                </div>

                <div class="card bg-secondary bg-opacity-10 border-secondary shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold border-bottom border-secondary pb-2 mb-3">Security</h6>
                        <form>
                            <div class="mb-3">
                                <input type="password" class="form-control bg-dark border-secondary text-light mb-2" placeholder="New Password">
                                <input type="password" class="form-control bg-dark border-secondary text-light" placeholder="Confirm Password">
                            </div>
                            <button class="btn btn-outline-warning border-warning btn-sm w-100 fw-semibold">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <h4 class="fw-bold mb-4">My Active Tasks</h4>
                
                <div class="card bg-secondary bg-opacity-10 border-secondary shadow-sm">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush border-secondary rounded">
                            
                            <li class="list-group-item bg-transparent border-secondary text-light p-3 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="text-primary small fw-bold me-2">Finance Management App</span>
                                        <span class="text-secondary small">#FIN-101</span>
                                    </div>
                                    <h6 class="fw-semibold mb-1">Draft schema.sql and data.sql files</h6>
                                    <span class="badge bg-warning text-dark me-1">In Progress</span>
                                </div>
                                <a href="kanban.html" class="btn btn-sm btn-outline-secondary border-secondary mt-2">View Board</a>
                            </li>

                            <li class="list-group-item bg-transparent border-secondary text-light p-3 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="text-success small fw-bold me-2">2D Engine</span>
                                        <span class="text-secondary small">#ENG-042</span>
                                    </div>
                                    <h6 class="fw-semibold mb-1">Implement gravity and collision mechanics</h6>
                                    <span class="badge bg-secondary text-light me-1">To Do</span>
                                </div>
                                <a href="kanban.html" class="btn btn-sm btn-outline-secondary border-secondary mt-2">View Board</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>