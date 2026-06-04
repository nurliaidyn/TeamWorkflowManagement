<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workflow Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark text-light py-5">

    <div class="container">
        <header class="mb-5 text-center">
            <h1 class="display-5 fw-bold">Project Alpha - Sprint Board</h1>
            <p class="text-secondary">Drag and drop tasks to update their status.</p>
        </header>

        <div class="row g-4 kanban-board">
            <div class="col-md-4">
                <div class="bg-secondary bg-opacity-25 rounded p-3 h-100 column" id="todo" data-status="todo">
                    <h5 class="border-bottom border-secondary pb-2 mb-3">To Do</h5>
                    <div class="task-list">
                        <div class="card bg-dark text-light border-secondary mb-3 task-card shadow-sm" draggable="true" id="task-1">
                            <div class="card-body p-3">
                                <p class="card-text mb-2 fw-semibold">Design Database Schema</p>
                                <span class="badge bg-danger">High Priority</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-secondary bg-opacity-25 rounded p-3 h-100 column" id="in-progress" data-status="in_progress">
                    <h5 class="border-bottom border-secondary pb-2 mb-3">In Progress</h5>
                    <div class="task-list">
                        <div class="card bg-dark text-light border-secondary mb-3 task-card shadow-sm" draggable="true" id="task-2">
                            <div class="card-body p-3">
                                <p class="card-text mb-2 fw-semibold">Build Bootstrap Prototype</p>
                                <span class="badge bg-warning text-dark">Medium Priority</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-secondary bg-opacity-25 rounded p-3 h-100 column" id="done" data-status="done">
                    <h5 class="border-bottom border-secondary pb-2 mb-3">Done</h5>
                    <div class="task-list">
                        </div>
                </div>
            </div>
        </div>

        <!-- detailed cards that appear when clicked -->
        <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark text-light border-secondary">
                    
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title" id="taskModalLabel">Edit Task</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <form id="editTaskForm">
                            <input type="hidden" id="modalTaskId">

                            <div class="mb-3">
                                <label for="modalTaskTitle" class="form-label text-secondary">Task Title</label>
                                <input type="text" class="form-control bg-dark text-light border-secondary" id="modalTaskTitle" required>
                            </div>

                            <div class="mb-3">
                                <label for="modalTaskDescription" class="form-label text-secondary">Description</label>
                                <textarea class="form-control bg-dark text-light border-secondary" id="modalTaskDescription" rows="4"></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="modalTaskPriority" class="form-label text-secondary">Priority</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="modalTaskPriority">
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="modalTaskStatus" class="form-label text-secondary">Status</label>
                                    <select class="form-select bg-dark text-light border-secondary" id="modalTaskStatus">
                                        <option value="todo">To Do</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="done">Done</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveTaskChanges">Save Changes</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>