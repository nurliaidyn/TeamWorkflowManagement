<?php
session_start();
require_once '../config/db.php';

// Security check: Only admins can change roles
if (!isset($_SESSION['system_role']) || $_SESSION['system_role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['target_user_id']) && isset($data['new_role'])) {
    // Prevent an admin from accidentally changing their own role and locking themselves out
    if ($data['target_user_id'] == $_SESSION['user_id']) {
         echo json_encode(['status' => 'error', 'message' => 'You cannot change your own role.']);
         exit;
    }

    $sql = "UPDATE users SET system_role = :role WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([':role' => $data['new_role'], ':id' => $data['target_user_id']])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
}
?>