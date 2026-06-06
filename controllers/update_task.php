<?php

require_once '../config/db.php'; 

// 1. Read the raw JSON data sent by the JavaScript fetch() request
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

// 2. Verify we received the necessary information
if (isset($data['task_id']) && isset($data['new_status'])) {
    
    // Strip the "task-" prefix from the HTML ID to get just the database ID number
    $taskId = str_replace('task-', '', $data['task_id']);
    $newStatus = $data['new_status'];
    
    // 3. Prepare and execute the secure SQL UPDATE
    $sql = "UPDATE tasks SET status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':status' => $newStatus, ':id' => $taskId])) {
        // Send a success message back to the browser
        echo json_encode(['status' => 'success', 'message' => "Task $taskId moved to $newStatus."]);
    } else {
        // Send a failure message if the database rejects it
        echo json_encode(['status' => 'error', 'message' => 'Database update failed.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing task ID or status.']);
}
?>