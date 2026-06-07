<?php
session_start();
require_once '../config/db.php';

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['task_id']) && isset($data['comment_text']) && isset($_SESSION['user_id'])) {
    $sql = "INSERT INTO task_comments (task_id, user_id, comment_text) VALUES (:task_id, :user_id, :comment_text)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([
        ':task_id' => $data['task_id'],
        ':user_id' => $_SESSION['user_id'],
        ':comment_text' => trim($data['comment_text'])
    ])) {
        echo json_encode([
            'status' => 'success',
            'nickname' => $_SESSION['user_name'],
            'author_id' => $_SESSION['user_id'],
            'created_at' => date('Y-m-d H:i:s') // Send the current timestamp back
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
}
?>