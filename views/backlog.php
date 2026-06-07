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
            <a class="navbar-brand fs-6 text-secondary hover-white" href="index.php?page=dashboard">
                <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-1">Product Backlog</h2>
                <p class="text-secondary m-0"><i class="bi bi-folder2-open me-2"></i><?= htmlspecialchars($project['name']) ?></p>
            </div>
            <button class="btn btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#newTaskModal">
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
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Reporter</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 border-secondary">Assignee</th>
                                <th class="text-secondary small text-uppercase pb-3 pt-3 pe-4 text-end border-secondary">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-secondary">
                            
                            <?php if (!empty($backlog_tasks)): ?>
                                <?php foreach ($backlog_tasks as $task): ?>
                                    <tr id="row-<?= $task['id'] ?>">
                                        <td class="ps-4"><span class="text-secondary">#<?= $task['id'] ?></span></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($task['title']) ?></td>
                                        
                                        <td><span class="text-secondary small"><?= htmlspecialchars($task['reporter_name']) ?></span></td>
                                        
                                        <td>
                                            <?php if ($task['assignee_name']): ?>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center me-2 shadow-sm" style="width: 24px; height: 24px; font-size: 0.7rem;">
                                                        <?= strtoupper(substr($task['assignee_name'], 0, 1)) ?>
                                                    </div>
                                                    <span class="small"><?= htmlspecialchars($task['assignee_name']) ?></span>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-secondary small"><i class="bi bi-person-dash me-1"></i> Unassigned</span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="pe-4 text-end">
                                            <div class="btn-group shadow-sm">
                                                <button class="btn btn-outline-primary border-secondary btn-sm to-sprint-btn" data-task-id="<?= $task['id'] ?>">To Sprint</button>
                                                <button class="btn btn-outline-secondary border-secondary btn-sm edit-btn" data-task-id="<?= $task['id'] ?>" title="Edit Task"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-outline-danger border-secondary btn-sm delete-btn" data-task-id="<?= $task['id'] ?>" title="Delete Task"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-secondary">
                                        <i class="bi bi-check2-circle fs-4 d-block mb-2"></i>
                                        Backlog is empty.
                                    </td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Add a task ------------------------ -->
    <div class="modal fade" id="newTaskModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary text-light shadow-lg">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold">Add to Backlog</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createTaskForm">
                        <input type="hidden" id="taskProjectId" value="<?= $project_id ?>">
                        
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Task Title</label>
                            <input type="text" id="taskTitle" class="form-control bg-dark border-secondary text-light" placeholder="e.g., Update API documentation" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Description (Optional)</label>
                            <textarea id="taskDescription" class="form-control bg-dark border-secondary text-light" rows="3" placeholder="Add context or acceptance criteria..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small text-uppercase fw-bold">Deadline (Optional)</label>
                                <input type="datetime-local" id="taskDeadline" class="form-control bg-dark border-secondary text-light">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small text-uppercase fw-bold">Assign To</label>
                                <select id="taskAssignee" class="form-select bg-dark border-secondary text-light">
                                    <option value="">Unassigned</option>
                                    <?php foreach ($team_members as $member): ?>
                                        <option value="<?= $member['id'] ?>"><?= htmlspecialchars($member['nickname']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary border-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="submitNewTask" class="btn btn-primary fw-semibold">
                        <span class="btn-text">Save Task</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- EDIT TASK -->
    <div class="modal fade" id="editTaskModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary text-light shadow-lg">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold">Edit Task</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm">
                        <input type="hidden" id="editTaskId">
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Task Title</label>
                            <input type="text" id="editTaskTitle" class="form-control bg-dark border-secondary text-light" required>
                        </div>
                        </form>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary border-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="submitEditTask" class="btn btn-warning fw-semibold">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.querySelector('tbody').addEventListener('click', function(event) {
                
                const sprintBtn = event.target.closest('.to-sprint-btn');
                

                // DELETE HANDLE
                const deleteBtn = event.target.closest('.delete-btn');
                if (deleteBtn) {
                    if (!confirm("Are you sure you want to permanently delete this task?")) return;
                    
                    const taskId = deleteBtn.getAttribute('data-task-id');
                    const row = document.getElementById(`row-${taskId}`);
                    
                    fetch('controllers/delete_task.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ task_id: taskId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            row.style.transition = 'opacity 0.4s, transform 0.4s';
                            row.style.opacity = '0';
                            row.style.transform = 'translateX(-20px)';
                            setTimeout(() => row.remove(), 400);
                        } else {
                            alert(data.message);
                        }
                    });
                    return;
                }
                // EDIT HANDLE
                const editBtn = event.target.closest('.edit-btn');
                if (editBtn) {
                    const taskId = editBtn.getAttribute('data-task-id');
                    const row = document.getElementById(`row-${taskId}`);
                    
                    // Grab the current title directly from the HTML table row
                    const currentTitle = row.querySelector('.fw-semibold').innerText;
                    
                    // Populate the modal
                    document.getElementById('editTaskId').value = taskId;
                    document.getElementById('editTaskTitle').value = currentTitle;
                    
                    // Show the modal
                    new bootstrap.Modal(document.getElementById('editTaskModal')).show();
                    return;
                }

                if (!sprintBtn) return; 

                const taskId = sprintBtn.getAttribute('data-task-id');
                const row = document.getElementById(`row-${taskId}`);
                
                sprintBtn.disabled = true;
                sprintBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

                fetch('controllers/update_task.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        task_id: taskId,
                        new_status: 'todo'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Fade out and remove the row
                        row.style.transition = 'opacity 0.4s';
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 400);
                    } else {
                        alert('Failed to move task: ' + data.message);
                        sprintBtn.disabled = false;
                        sprintBtn.innerText = 'To Sprint';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Network error.');
                    sprintBtn.disabled = false;
                    sprintBtn.innerText = 'To Sprint';
                });
            });
            
            sprintButtons.forEach(sprintBtn => {
                sprintBtn.addEventListener('click', function() {
                    const taskId = this.getAttribute('data-task-id');
                    const row = document.getElementById(`row-${taskId}`);
                    
                    // Disable button to prevent double clicks
                    this.disabled = true;
                    this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

                    // Reusing our existing API! Send it to the "todo" column
                    fetch('controllers/update_task.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            task_id: taskId,
                            new_status: 'todo'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Fade out and remove the row
                            row.style.transition = 'opacity 0.4s';
                            row.style.opacity = '0';
                            setTimeout(() => row.remove(), 400);
                        } else {
                            alert('Failed to move task: ' + data.message);
                            this.disabled = false;
                            this.innerText = 'To Sprint';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Network error.');
                        this.disabled = false;
                        this.innerText = 'To Sprint';
                    });
                });
            });
        });


        // Handle New Task Creation
        const submitBtn = document.getElementById('submitNewTask');
        const titleInput = document.getElementById('taskTitle');
        const descInput = document.getElementById('taskDescription');
        const projectId = document.getElementById('taskProjectId').value;
        const form = document.getElementById('createTaskForm');
        const deadlineInput = document.getElementById('taskDeadline');
        const assigneeInput = document.getElementById('taskAssignee');

        submitBtn.addEventListener('click', () => {
            // Basic validation
            if (!titleInput.value.trim()) {
                titleInput.classList.add('is-invalid');
                return;
            }
            titleInput.classList.remove('is-invalid');

            // UI Loading state
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.spinner-border');
            btnText.classList.add('d-none');
            spinner.classList.remove('d-none');
            submitBtn.disabled = true;

            // Send to PHP API
            fetch('controllers/create_task.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    project_id: projectId,
                    title: titleInput.value,
                    description: descInput.value,
                    end_date: deadlineInput.value,
                    assignee_id: assigneeInput.value // <-- Send the Assignee ID
                })
            })
            .then(response => response.json())
            .then(data => {
                // Reset UI
                btnText.classList.remove('d-none');
                spinner.classList.add('d-none');
                submitBtn.disabled = false;

                if (data.status === 'success') {
                    // Hide Modal
                    const modalInstance = bootstrap.Modal.getInstance(document.getElementById('newTaskModal'));
                    modalInstance.hide();
                    form.reset();

                    // Create a new table row dynamically
                    const tbody = document.querySelector('tbody');
                    
                    // Remove the "empty backlog" message if it exists
                    if (tbody.querySelector('td[colspan="5"]')) {
                        tbody.innerHTML = ''; 
                    }

                    const newRow = document.createElement('tr');
                    newRow.id = `row-${data.id}`;
                    // Add a subtle green background animation to show it was just added
                    newRow.style.backgroundColor = 'rgba(25, 135, 84, 0.2)';
                    newRow.style.transition = 'background-color 1s ease';

                    newRow.innerHTML = `
                        <td class="ps-4"><span class="text-secondary">#${data.id}</span></td>
                        <td class="fw-semibold">${data.title}</td>
                        <td><span class="text-secondary small">${data.reporter_name}</span></td>
                        <td><span class="text-secondary small"><i class="bi bi-person-dash me-1"></i> Unassigned</span></td>
                        <td class="pe-4 text-end">
                            <div class="btn-group shadow-sm">
                                <button class="btn btn-outline-primary border-secondary btn-sm to-sprint-btn" data-task-id="${data.id}">To Sprint</button>
                                <button class="btn btn-outline-secondary border-secondary btn-sm edit-btn" data-task-id="${data.id}" title="Edit Task"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-outline-danger border-secondary btn-sm delete-btn" data-task-id="${data.id}" title="Delete Task"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    `;
                    const assigneeName = assigneeInput.options[assigneeInput.selectedIndex].text;
                    const isAssigned = assigneeInput.value !== "";
                    const assigneeHtml = isAssigned 
                        ? `<div class="d-flex align-items-center">
                            <div class="bg-info text-white rounded-circle d-flex justify-content-center align-items-center me-2 shadow-sm" style="width: 24px; height: 24px; font-size: 0.7rem;">
                                ${assigneeName.charAt(0).toUpperCase()}
                            </div>
                            <span class="small">${assigneeName}</span>
                        </div>`
                        : `<span class="text-secondary small"><i class="bi bi-person-dash me-1"></i> Unassigned</span>`;

                    // Use that variable when creating the new row
                    newRow.innerHTML = `
                        <td class="ps-4"><span class="text-secondary">#${data.id}</span></td>
                        <td class="fw-semibold">${data.title}</td>
                        <td><span class="text-secondary small">${data.reporter_name}</span></td>
                        <td>${assigneeHtml}</td>
                        <td class="pe-4 text-end">
                            <div class="btn-group shadow-sm">
                                <button class="btn btn-outline-primary border-secondary btn-sm to-sprint-btn" data-task-id="${data.id}">To Sprint</button>
                                <button class="btn btn-outline-secondary border-secondary btn-sm edit-btn" data-task-id="${data.id}" title="Edit Task"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-outline-danger border-secondary btn-sm delete-btn" data-task-id="${data.id}" title="Delete Task"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    `;

                    // Add it to the top of the table
                    tbody.prepend(newRow);

                    // Fade out the green highlight after 1 second
                    setTimeout(() => {
                        newRow.style.backgroundColor = 'transparent';
                    }, 1000);

                    // Important: We must re-attach the "To Sprint" event listener to this brand new button
                    // (You can copy the logic from your existing sprint button handler here, or wrap it in a reusable function)
                    


                } else {
                    alert('Failed to create task: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Network error.');
                btnText.classList.remove('d-none');
                spinner.classList.add('d-none');
                submitBtn.disabled = false;
            });
        });
    </script>
</body>
</html>