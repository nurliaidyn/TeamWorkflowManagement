<?php
session_start();
require_once '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['task_id']) && isset($data['title']) && isset($_SESSION['user_id'])) {
    $sql = "UPDATE tasks SET title = :title WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':title' => $data['title'], ':id' => $data['task_id']])) {
        echo json_encode(['status' => 'success', 'new_title' => htmlspecialchars($data['title'])]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>