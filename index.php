<?php
session_start();
require_once 'config/db.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$public_routes = ['login', 'register'];

if (!isset($_SESSION['user_id']) && !in_array($page, $public_routes)) {
    header("Location: index.php?page=login");
    exit;
}

if ($page === 'logout') {
    session_destroy();
    header("Location: index.php?page=login");
    exit;
}

switch ($page) {
    case 'login':
        require_once 'views/login.php';
        break;
        
    case 'register':
        require_once 'views/register.php';
        break;
    case 'dashboard':
        // 1. Fetch the user's ACTIVE projects only
        $sql = "
            SELECT p.id, p.name, p.description, pm.project_role 
            FROM projects p
            JOIN project_members pm ON p.id = pm.project_id
            WHERE pm.user_id = :user_id AND p.is_active = 1
            ORDER BY p.created_at DESC
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $projects = $stmt->fetchAll(); 
        
        // 2. Fetch available users for the "Assign Team" modal checkboxes
        $stmtUsers = $pdo->prepare("SELECT id, nickname, full_name FROM users WHERE is_active = 1 AND id != :my_id ORDER BY nickname ASC");
        $stmtUsers->execute([':my_id' => $_SESSION['user_id']]);
        $available_users = $stmtUsers->fetchAll();
        
        // 3. Load the view
        require_once 'views/dashboard.php';
        break;
    case 'admin':
        if (!isset($_SESSION['system_role']) || $_SESSION['system_role'] !== 'admin') {
            header("Location: index.php?page=dashboard");
            exit;
        }

        // 1. Fetch Users
        $stmt = $pdo->query("SELECT id, full_name, nickname, email, system_role, is_active, created_at FROM users ORDER BY created_at DESC");
        $all_users = $stmt->fetchAll();

        // 2. Fetch Projects (Joining the users table to see who created it)
        $stmtProjects = $pdo->query("
            SELECT p.id, p.name, p.description, p.is_active, p.created_at, u.nickname as creator_name 
            FROM projects p 
            LEFT JOIN users u ON p.created_by = u.id 
            ORDER BY p.created_at DESC
        ");
        $all_projects = $stmtProjects->fetchAll();

        require_once 'views/admin.php';
        break;

    case 'board':

        if (!isset($_GET['project_id']) || !is_numeric($_GET['project_id'])) {
            header("Location: index.php?page=dashboard");
            exit;
        }
        $project_id = (int)$_GET['project_id'];

        $stmt = $pdo->prepare("SELECT name FROM projects WHERE id = :id");
        $stmt->execute([':id' => $project_id]);
        $project = $stmt->fetch();

        if (!$project) {
            header("Location: index.php?page=dashboard");
            exit;
        }

        $sql = "
            SELECT t.id, t.title, t.status, u.nickname as assignee_name
            FROM tasks t
            LEFT JOIN users u ON t.assignee_id = u.id
            WHERE t.project_id = :project_id AND t.status != 'backlog'
            ORDER BY t.updated_at DESC
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':project_id' => $project_id]);
        $all_tasks = $stmt->fetchAll();

        // 4. Sort tasks into buckets for easy rendering in the HTML
        $tasks = [
            'todo' => [],
            'in_progress' => [],
            'done' => []
        ];
        
        foreach ($all_tasks as $task) {
            if (array_key_exists($task['status'], $tasks)) {
                $tasks[$task['status']][] = $task;
            }
        }

        // 5. Load the dynamic view
        require_once 'views/kanban.php';
        break;
    case 'backlog':
        if (!isset($_GET['project_id']) || !is_numeric($_GET['project_id'])) {
            header("Location: index.php?page=dashboard");
            exit;
        }
        $project_id = (int)$_GET['project_id'];

        // 1. Fetch the Project Name
        $stmt = $pdo->prepare("SELECT name FROM projects WHERE id = :id");
        $stmt->execute([':id' => $project_id]);
        $project = $stmt->fetch();

        if (!$project) {
            header("Location: index.php?page=dashboard");
            exit;
        }

        // 2. Fetch ONLY Backlog Tasks 
        // We also JOIN the users table twice: once for the reporter, once for the assignee
        $sql = "
            SELECT t.id, t.title, r.nickname as reporter_name, a.nickname as assignee_name, t.created_at
            FROM tasks t
            LEFT JOIN users r ON t.reporter_id = r.id
            LEFT JOIN users a ON t.assignee_id = a.id
            WHERE t.project_id = :project_id AND t.status = 'backlog'
            ORDER BY t.created_at DESC
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':project_id' => $project_id]);
        $backlog_tasks = $stmt->fetchAll();

        $stmt = $pdo->prepare("
            SELECT u.id, u.nickname
            FROM project_members pm
            JOIN users u ON pm.user_id = u.id
            WHERE pm.project_id = :project_id
            ORDER BY u.nickname ASC
        ");
        $stmt->execute([':project_id' => $project_id]);
        $team_members = $stmt->fetchAll();

        require_once 'views/backlog.php';

        break;
    case 'profile':
        $stmt = $pdo->prepare("SELECT email, system_role, nickname, full_name FROM users WHERE id = :id");
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user_profile = $stmt->fetch();

        $sql = "
            SELECT t.id, t.title, t.status, p.id as project_id, p.name as project_name
            FROM tasks t
            JOIN projects p ON t.project_id = p.id
            WHERE t.assignee_id = :user_id AND t.status != 'done'
            ORDER BY t.status DESC, t.updated_at DESC
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        $my_tasks = $stmt->fetchAll();

        require_once 'views/profile.php';
        break;

}
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workflow Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>
</html>