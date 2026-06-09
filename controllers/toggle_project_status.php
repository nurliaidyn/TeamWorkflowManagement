<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['system_role']) || $_SESSION['system_role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['project_id']) && isset($data['new_status'])) {
    $sql = "UPDATE projects SET is_active = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':status' => $data['new_status'], ':id' => $data['project_id']])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
}
?>