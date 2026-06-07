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
    <div class="modal fade" id="newProjectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary text-light shadow-lg">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold">Create New Workspace</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createProjectForm">
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Project Name</label>
                            <input type="text" id="projectName" class="form-control bg-dark border-secondary text-light" placeholder="e.g., Mobile App V2" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Description</label>
                            <textarea id="projectDesc" class="form-control bg-dark border-secondary text-light" rows="3" placeholder="What is the goal of this workspace?"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small text-uppercase fw-bold">Assign Team Members</label>
                            <div class="border border-secondary rounded p-2 bg-dark" style="max-height: 120px; overflow-y: auto;">
                                <?php if (!empty($available_users)): ?>
                                    <?php foreach($available_users as $u): ?>
                                        <div class="form-check mb-1">
                                            <input class="form-check-input team-member-checkbox bg-secondary border-secondary" type="checkbox" value="<?= $u['id'] ?>" id="user_<?= $u['id'] ?>">
                                            <label class="form-check-label text-light small" for="user_<?= $u['id'] ?>">
                                                <?= htmlspecialchars($u['nickname']) ?> <span class="text-secondary">(<?= htmlspecialchars($u['full_name']) ?>)</span>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-secondary small fst-italic">No other active users found.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small text-uppercase fw-bold">Start Date</label>
                                <input type="date" id="projectStart" class="form-control bg-dark border-secondary text-light" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-secondary small text-uppercase fw-bold">Target End Date</label>
                                <input type="date" id="projectEnd" class="form-control bg-dark border-secondary text-light">
                            </div>
                        </div>
                    </form>
                    
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-secondary border-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="submitNewProject" class="btn btn-primary fw-semibold">
                        <span class="btn-text">Create Workspace</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const submitBtn = document.getElementById('submitNewProject');
            
            if (submitBtn) {
                submitBtn.addEventListener('click', () => {
                    const nameInput = document.getElementById('projectName');
                    const descInput = document.getElementById('projectDesc');
                    const startInput = document.getElementById('projectStart');
                    const endInput = document.getElementById('projectEnd');
                    
                    // Basic Validation
                    if (!nameInput.value.trim() || !startInput.value) {
                        nameInput.classList.add('is-invalid');
                        return;
                    }
                    nameInput.classList.remove('is-invalid');

                    // UI Loading state
                    // const btnText = submitBtn.querySelector('.btn-text');
                    // const spinner = submitBtn.querySelector('.spinner-border');
                    // btnText.classList.add('d-none');
                    // spinner.classList.remove('d-none');
                    // submitBtn.disabled = true;

                    // // Send to API
                    // fetch('controllers/create_project.php', {
                    //     method: 'POST',
                    //     headers: { 'Content-Type': 'application/json' },
                    //     body: JSON.stringify({
                    //         name: nameInput.value,
                    //         description: descInput.value,
                    //         start_date: startInput.value,
                    //         end_date: endInput.value
                    //     })
                    // })

                    // 1. Gather all checked checkboxes into an array
                    const selectedMembers = [];
                    document.querySelectorAll('.team-member-checkbox:checked').forEach(checkbox => {
                        selectedMembers.push(checkbox.value);
                    });

                    // UI Loading state
                    const btnText = submitBtn.querySelector('.btn-text');
                    const spinner = submitBtn.querySelector('.spinner-border');
                    btnText.classList.add('d-none');
                    spinner.classList.remove('d-none');
                    submitBtn.disabled = true;

                    // 2. Add the array to the payload
                    fetch('controllers/create_project.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            name: nameInput.value,
                            description: descInput.value,
                            start_date: startInput.value,
                            end_date: endInput.value,
                            team_members: selectedMembers // <-- New data sent to PHP
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Reset UI
                        btnText.classList.remove('d-none');
                        spinner.classList.add('d-none');
                        submitBtn.disabled = false;

                        if (data.status === 'success') {
                            // Hide the modal
                            bootstrap.Modal.getInstance(document.getElementById('newProjectModal')).hide();
                            document.getElementById('createProjectForm').reset();
                            document.getElementById('projectStart').value = new Date().toISOString().split('T')[0];

                            // Check if the empty state message exists, and remove it if it does
                            const emptyState = document.querySelector('.bi-folder-x');
                            if (emptyState) {
                                emptyState.closest('.col-12').remove();
                            }

                            // Generate the new HTML Card
                            const newCardHtml = `
                                <div class="col-md-4">
                                    <div class="card bg-secondary bg-opacity-10 border-secondary h-100 hover-shadow" style="background-color: rgba(25, 135, 84, 0.1) !important; transition: background-color 1s ease;">
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h5 class="card-title fw-bold m-0">${data.name}</h5>
                                                <span class="badge bg-danger bg-opacity-25 text-danger border border-danger">Lead</span>
                                            </div>
                                            <p class="card-text text-secondary small mb-4">${data.description}</p>
                                            <div class="mt-auto">
                                                <div class="d-flex gap-2 mt-4">
                                                    <a href="?page=board&project_id=${data.id}" class="btn btn-primary btn-sm flex-grow-1">Board</a>
                                                    <a href="?page=backlog&project_id=${data.id}" class="btn btn-outline-secondary border-secondary btn-sm flex-grow-1">Backlog</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                            // Target the grid container and insert the card at the beginning
                            const gridContainer = document.querySelector('.row.g-4');
                            gridContainer.insertAdjacentHTML('afterbegin', newCardHtml);
                            
                            // Remove the subtle green highlight after a second
                            setTimeout(() => {
                                gridContainer.firstElementChild.querySelector('.card').style.backgroundColor = '';
                            }, 1000);

                        } else {
                            alert('Failed to create workspace: ' + data.message);
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
            }
        });
    </script>
</body>
</html>