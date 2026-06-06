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
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center">
                <a class="btn btn-sm btn-outline-secondary border-secondary me-3" href="dashboard.php">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <h5 class="m-0 fw-bold"><i class="bi bi-kanban me-2 text-primary"></i>Finance Management App</h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge bg-secondary bg-opacity-25 text-light border border-secondary me-3">Sprint 4 Active</span>
                <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;">N</div>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 kanban-scroll d-flex gap-4 pb-4">
        
        <div class="kanban-column d-flex flex-column" data-status="todo">
            <div class="bg-secondary bg-opacity-10 rounded p-3 h-100 border border-secondary">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-secondary">
                    <h6 class="text-uppercase fw-bold m-0 text-secondary">To Do <span class="badge bg-secondary ms-2 rounded-pill">2</span></h6>
                    <button class="btn btn-sm btn-link text-secondary p-0"><i class="bi bi-plus-lg"></i></button>
                </div>
                
                <div class="task-list d-flex flex-column gap-3">
                    <div class="card bg-dark text-light border-secondary shadow-sm task-card" draggable="true" id="task-101">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary small">#FIN-101</span>
                                <span class="badge bg-danger bg-opacity-25 text-danger border border-danger">High</span>
                            </div>
                            <p class="card-text fw-semibold mb-3">Draft schema.sql and data.sql files</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="bi bi-chat-square-text text-secondary small"> 2</i>
                                <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 24px; height: 24px; font-size: 0.7rem;">N</div>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-dark text-light border-secondary shadow-sm task-card" draggable="true" id="task-102">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary small">#FIN-102</span>
                                <span class="badge bg-secondary bg-opacity-25 text-secondary border border-secondary">Low</span>
                            </div>
                            <p class="card-text fw-semibold mb-3">Update user profile styling</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="bi bi-paperclip text-secondary small"> 1</i>
                                <span class="text-secondary small"><i class="bi bi-person-dash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kanban-column d-flex flex-column" data-status="in_progress">
            <div class="bg-secondary bg-opacity-10 rounded p-3 h-100 border border-secondary">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-primary">
                    <h6 class="text-uppercase fw-bold m-0 text-primary">In Progress <span class="badge bg-primary ms-2 rounded-pill">1</span></h6>
                </div>
                
                <div class="task-list d-flex flex-column gap-3">
                    <div class="card bg-dark text-light border-primary shadow-sm task-card" draggable="true" id="task-103">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary small">#FIN-103</span>
                                <span class="badge bg-warning bg-opacity-25 text-warning border border-warning">Medium</span>
                            </div>
                            <p class="card-text fw-semibold mb-3">Implement API endpoints for transaction history</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-dark border border-secondary text-secondary">Backend</span>
                                <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 24px; height: 24px; font-size: 0.7rem;">J</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kanban-column d-flex flex-column" data-status="done">
            <div class="bg-secondary bg-opacity-10 rounded p-3 h-100 border border-secondary">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom border-success">
                    <h6 class="text-uppercase fw-bold m-0 text-success">Done <span class="badge bg-success ms-2 rounded-pill">0</span></h6>
                </div>
                
                <div class="task-list d-flex flex-column gap-3">
                    </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Drag and Drop Logic
        const cards = document.querySelectorAll('.task-card');
        const lists = document.querySelectorAll('.task-list');

        cards.forEach(card => {
            card.addEventListener('dragstart', () => {
                card.classList.add('dragging');
            });

            card.addEventListener('dragend', () => {
                card.classList.remove('dragging');
                
                // For future PHP API call
                const newStatus = card.closest('.kanban-column').dataset.status;
                console.log(`Update ${card.id} to ${newStatus}`);
                
                // Update counter badges visually
                updateCounters();
            });
        });

        lists.forEach(list => {
            list.addEventListener('dragover', e => {
                e.preventDefault();
                const draggingCard = document.querySelector('.dragging');
                list.appendChild(draggingCard);
            });
        });

        function updateCounters() {
            document.querySelectorAll('.kanban-column').forEach(col => {
                const count = col.querySelectorAll('.task-card').length;
                col.querySelector('.badge.rounded-pill').innerText = count;
            });
        }
    </script>
</body>
</html>