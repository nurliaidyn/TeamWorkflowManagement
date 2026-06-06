<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backlog - Project Alpha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/css/style.css">

</head>
<body class="text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary bg-opacity-10 border-bottom border-secondary mb-4">
        <div class="container">
            <a class="navbar-brand fs-6 text-secondary hover-white" href="dashboard.php">
                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Product Backlog</h2>
                <p class="text-secondary m-0"><i class="bi bi-folder2-open me-2"></i>Finance Management App</p>
            </div>
            <button class="btn btn-success fw-semibold">
                <i class="bi bi-plus-lg"></i> Add Task
            </button>
        </div>

        <div class="card bg-secondary bg-opacity-10 border-secondary shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark mb-0 align-middle">
                        <thead class="border-secondary">
                            <tr>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 ps-4 border-secondary">ID</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Task Title</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Priority</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Assignee</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 pe-4 text-end border-secondary">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-secondary">
                            <tr>
                                <td class="ps-4"><span class="text-secondary">#FIN-042</span></td>
                                <td class="fw-semibold">Draft schema.sql and data.sql files</td>
                                <td><span class="badge bg-danger bg-opacity-25 text-danger border border-danger">High</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 24px; height: 24px; font-size: 0.7rem;">N</div>
                                        <span class="small">Niko</span>
                                    </div>
                                </td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-outline-primary border-secondary btn-sm">To Sprint</button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="ps-4"><span class="text-secondary">#FIN-043</span></td>
                                <td class="fw-semibold">Implement gravity and collision mechanics</td>
                                <td><span class="badge bg-warning bg-opacity-25 text-warning border border-warning">Medium</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width: 24px; height: 24px; font-size: 0.7rem;">J</div>
                                        <span class="small">Janar</span>
                                    </div>
                                </td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-outline-primary border-secondary btn-sm">To Sprint</button>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4"><span class="text-secondary">#FIN-044</span></td>
                                <td class="fw-semibold">Fix styling on Wayland-based components</td>
                                <td><span class="badge bg-secondary bg-opacity-25 text-secondary border border-secondary">Low</span></td>
                                <td><span class="text-secondary small"><i class="bi bi-person-dash me-1"></i> Unassigned</span></td>
                                <td class="pe-4 text-end">
                                    <button class="btn btn-outline-primary border-secondary btn-sm">To Sprint</button>
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