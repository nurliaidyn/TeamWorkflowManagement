<?php
session_start();
require_once '../config/db.php';

// 1. Read the JSON data sent from the browser
$data = json_decode(file_get_contents('php://input'), true);

// 2. Ensure we have the minimum required data and the user is logged in
if (isset($data['project_id']) && isset($data['title']) && isset($_SESSION['user_id'])) {
    
    $formattedDate = null;
    if (!empty($data['end_date'])) {
        $formattedDate = str_replace('T', ' ', $data['end_date']) . ':00';
    }

    // 1. Update the SQL to include assignee_id
    $sql = "INSERT INTO tasks (project_id, title, description, status, reporter_id, assignee_id, end_date) 
            VALUES (:project_id, :title, :description, 'backlog', :reporter_id, :assignee_id, :end_date)";
    
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            ':project_id'  => $data['project_id'],
            ':title'       => $data['title'],
            ':description' => $data['description'] ?? '',
            ':reporter_id' => $_SESSION['user_id'],
            // 2. Insert the assignee ID, or leave as NULL if "Unassigned" was chosen
            ':assignee_id' => !empty($data['assignee_id']) ? $data['assignee_id'] : null,
            ':end_date'    => $formattedDate
        ]);
        
        $newTaskId = $pdo->lastInsertId();
        
        echo json_encode([
            'status'        => 'success',
            'id'            => $newTaskId,
            'title'         => htmlspecialchars($data['title']),
            'reporter_name' => htmlspecialchars($_SESSION['user_name'])
        ]);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
}
?>