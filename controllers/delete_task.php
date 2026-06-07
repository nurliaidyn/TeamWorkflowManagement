<?php
session_start();
require_once '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['task_id']) && isset($_SESSION['user_id'])) {
    $sql = "DELETE FROM tasks WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':id' => $data['task_id']])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>