<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Project Alpha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/css/style.css">

</head>
<body class="text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary bg-opacity-10 border-bottom border-secondary mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href=""><i class="bi bi-braces text-primary"></i> Project Alpha</a>
            <div class="d-flex align-items-center">
                <span class="me-3 text-secondary small">Welcome, Niko</span>
                <a href="auth.php" class="btn btn-outline-secondary btn-sm border-secondary">Sign Out</a>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Your Workspaces</h2>
            <button class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                <i class="bi bi-plus-lg"></i> New Project
            </button>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card bg-secondary bg-opacity-10 border-secondary h-100 hover-shadow">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold m-0">Finance Management App</h5>
                            <span class="badge bg-success bg-opacity-25 text-success border border-success">Active</span>
                        </div>
                        <p class="card-text text-secondary small mb-4">
                            Core application for tracking transactions and financial forecasting.
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between text-secondary small mb-1">
                                <span>Sprint Progress</span>
                                <span>65%</span>
                            </div>
                            <div class="progress bg-dark mb-4" style="height: 6px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 65%;"></div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <a href="kanban.php" class="btn btn-primary btn-sm flex-grow-1">Board</a>
                                <a href="backlog.php" class="btn btn-outline-secondary border-secondary btn-sm flex-grow-1">Backlog</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-secondary bg-opacity-10 border-secondary h-100 hover-shadow">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold m-0">2D Side-Scroller Engine</h5>
                            <span class="badge bg-warning bg-opacity-25 text-warning border border-warning">Planning</span>
                        </div>
                        <p class="card-text text-secondary small mb-4">
                            HTML5 Canvas and JavaScript game engine development.
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between text-secondary small mb-1">
                                <span>Sprint Progress</span>
                                <span>15%</span>
                            </div>
                            <div class="progress bg-dark mb-4" style="height: 6px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 15%;"></div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <a href="kanban.php" class="btn btn-primary btn-sm flex-grow-1">Board</a>
                                <a href="backlog.php" class="btn btn-outline-secondary border-secondary btn-sm flex-grow-1">Backlog</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newProjectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary text-light shadow-lg">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold">Create New Project</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Project Name</label>
                            <input type="text" class="form-control bg-dark border-secondary text-light" placeholder="e.g., API Gateway Migration" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Description</label>
                            <textarea class="form-control bg-dark border-secondary text-light" rows="3" placeholder="Briefly describe the goal..." required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary border-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary fw-semibold">Create Project</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>