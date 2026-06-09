<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['system_role']) || $_SESSION['system_role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['project_id']) && isset($data['name'])) {
    $sql = "UPDATE projects SET name = :name, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([
        ':name' => $data['name'], 
        ':description' => $data['description'] ?? '', 
        ':id' => $data['project_id']
    ])) {
        echo json_encode(['status' => 'success', 'name' => htmlspecialchars($data['name'])]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
}
?>