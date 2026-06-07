<?php
session_start();
require_once '../config/db.php';

if (isset($_GET['task_id'])) {
    // We JOIN the users table to grab the author's nickname
    $sql = "SELECT c.id, c.comment_text, c.created_at, u.nickname, u.id as author_id
            FROM task_comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.task_id = :task_id
            ORDER BY c.created_at ASC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':task_id' => $_GET['task_id']]);
    $comments = $stmt->fetchAll();

    // Pass back the current user's ID so JavaScript knows which messages belong to "Me"
    echo json_encode([
        'status' => 'success', 
        'current_user_id' => $_SESSION['user_id'],
        'comments' => $comments
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing task ID.']);
}
?>