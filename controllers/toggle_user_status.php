<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['system_role']) || $_SESSION['system_role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['target_user_id']) && isset($data['new_status'])) {
    if ($data['target_user_id'] == $_SESSION['user_id']) {
         echo json_encode(['status' => 'error', 'message' => 'You cannot deactivate yourself.']);
         exit;
    }

    $sql = "UPDATE users SET is_active = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':status' => $data['new_status'], ':id' => $data['target_user_id']])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
}
?>