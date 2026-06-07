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
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-braces text-primary"></i> Project Alpha</a>
            <div class="d-flex align-items-center">
                <span class="me-3 text-secondary small">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <a href="?page=logout" class="btn btn-outline-secondary btn-sm border-secondary">Sign Out</a>
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
            
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="col-md-4">
                        <div class="card bg-secondary bg-opacity-10 border-secondary h-100 hover-shadow">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold m-0"><?= htmlspecialchars($project['name']) ?></h5>
                                    
                                    <?php if ($project['project_role'] === 'lead'): ?>
                                        <span class="badge bg-danger bg-opacity-25 text-danger border border-danger">Lead</span>
                                    <?php else: ?>
                                        <span class="badge bg-success bg-opacity-25 text-success border border-success">Active</span>
                                    <?php endif; ?>
                                </div>
                                
                                <p class="card-text text-secondary small mb-4">
                                    <?= htmlspecialchars($project['description']) ?>
                                </p>
                                
                                <div class="mt-auto">
                                    <div class="d-flex gap-2 mt-4">
                                        <a href="?page=board&project_id=<?= $project['id'] ?>" class="btn btn-primary btn-sm flex-grow-1">Board</a>
                                        <a href="?page=backlog&project_id=<?= $project['id'] ?>" class="btn btn-outline-secondary border-secondary btn-sm flex-grow-1">Backlog</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-folder-x display-1 text-secondary mb-3"></i>
                    <h4 class="text-secondary">No projects found.</h4>
                    <p class="text-secondary">You haven't been assigned to any workspaces yet.</p>
                </div>
            <?php endif; ?>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>