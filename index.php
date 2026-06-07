<?php
session_start();
require_once 'config/db.php'; // Bring in your PDO connection


if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = 'Niko';
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

switch ($page) {
    case 'dashboard':
        $sql = "
            SELECT p.id, p.name, p.description, pm.project_role 
            FROM projects p
            JOIN project_members pm ON p.id = pm.project_id
            WHERE pm.user_id = :user_id
            ORDER BY p.created_at DESC
        ";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        
        $projects = $stmt->fetchAll(); 
        
        require_once 'views/dashboard.php';
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