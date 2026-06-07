<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban Board - Project Alpha</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body class="text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary bg-opacity-10 border-bottom border-secondary mb-4">
        <div class="container px-4">
            <div class="d-flex align-items-center">
                <a class="btn btn-sm btn-outline-secondary border-secondary me-3" href="index.php?page=dashboard">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <h5 class="m-0 fw-bold"><i class="bi bi-kanban me-2 text-primary"></i><?= htmlspecialchars($project['name']) ?></h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="?page=profile" class="text-decoration-none d-flex align-items-center">
                    <span class="text-secondary small fw-semibold border-bottom border-transparent hover-border-secondary transition-all me-3">
                        Welcome, <?= htmlspecialchars($_SESSION['user_name'])   ?>
                    </span>

                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2 shadow-sm" style="width: 32px; height: 32px; font-size: 0.85rem;" title="My Profile">
                        <?= strtoupper(substr(htmlspecialchars($_SESSION['user_name']), 0, 1)) ?>
                    </div>

                </a>
                <?php if (isset($_SESSION['system_role']) && $_SESSION['system_role'] === 'admin'): ?>
                    <a href="?page=admin" class="btn btn-outline-danger btn-sm border-danger me-3">
                        <i class="bi bi-shield-lock"></i> Admin Console
                    </a>
                <?php endif; ?>
                
                <a href="?page=logout" class="btn btn-outline-secondary btn-sm border-secondary">Sign Out</a>
            </div>
        </div>
    </nav>

    <div class="container px-4 kanban-scroll d-flex gap-4 pb-5">
    <!-- <div class="container-fluid px-4 kanban-scroll d-flex gap-4 pb-5"> -->
    <!-- <div class="container pb-5"> -->
        
        <?php 
        // Helper array to generate the columns cleanly without repeating HTML
        $columns = [
            'todo' => ['title' => 'To Do', 'color' => 'secondary'],
            'in_progress' => ['title' => 'In Progress', 'color' => 'primary'],
            'done' => ['title' => 'Done', 'color' => 'success']
        ];
        ?>

        <?php foreach ($columns as $statusKey => $colData): ?>
            <div class="kanban-column d-flex flex-column" data-status="<?= $statusKey ?>">
                <div class="bg-secondary bg-opacity-10 rounded p-3 h-100 border border-secondary">
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-<?= $colData['color'] ?>">
                        <h6 class="text-uppercase fw-bold m-0 text-<?= $colData['color'] ?>">
                            <?= $colData['title'] ?> 
                            <span class="badge bg-<?= $colData['color'] ?> ms-2 rounded-pill"><?= count($tasks[$statusKey]) ?></span>
                        </h6>
                    </div>
                    
                    <div class="task-list d-flex flex-column gap-3">
                        
                        <?php foreach ($tasks[$statusKey] as $task): ?>
                            <div class="card bg-dark text-light border-<?= $colData['color'] ?> shadow-sm task-card" draggable="true" id="task-<?= $task['id'] ?>">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-secondary small">#TASK-<?= $task['id'] ?></span>
                                    </div>
                                    <p class="card-text fw-semibold mb-3"><?= htmlspecialchars($task['title']) ?></p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div></div> <?php if ($task['assignee_name']): ?>
                                            <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center shadow-sm" style="width: 24px; height: 24px; font-size: 0.7rem;" title="<?= htmlspecialchars($task['assignee_name']) ?>">
                                                <?= strtoupper(substr($task['assignee_name'], 0, 1)) ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-secondary small" title="Unassigned"><i class="bi bi-person-dash"></i></span>
                                        <?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="modal fade" id="kanbanTaskModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border-secondary text-light shadow-lg">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold" id="modalTaskTitle">Task Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body p-0">
                    <div class="p-3" style="height: 350px; overflow-y: auto; background-color: #1a1a24;" id="chatHistory">
                        <div class="text-center text-secondary mt-5">
                            <div class="spinner-border spinner-border-sm" role="status"></div> Loading discussion...
                        </div>
                    </div>

                    <div class="p-3 border-top border-secondary bg-dark">
                        <form id="commentForm" class="d-flex gap-2">
                            <input type="hidden" id="activeTaskId">
                            <input type="text" id="commentInput" class="form-control bg-secondary bg-opacity-10 border-secondary text-light" placeholder="Ask a question or post an update..." autocomplete="off" required>
                            <button type="submit" class="btn btn-primary px-4 fw-semibold"><i class="bi bi-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/script.js"></script> 
</body>
</html>