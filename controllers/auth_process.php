<?php
// controllers/auth_process.php
session_start();
require_once '../config/db.php';

$action = $_POST['action'] ?? '';


if ($action === 'register') {
    $fullName = trim($_POST['full_name']);
    $nickname = trim($_POST['nickname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if email or nickname already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email OR nickname = :nickname");
    $stmt->execute([':email' => $email, ':nickname' => $nickname]);
    
    if ($stmt->rowCount() > 0) {
        // In a real app, you'd pass this error back to the UI nicely. 
        // For now, we redirect back with an error flag.
        header("Location: ../index.php?page=register&error=exists");
        exit;
    }

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $sql = "INSERT INTO users (full_name, nickname, email, password_hash, system_role) 
            VALUES (:full_name, :nickname, :email, :password, 'developer')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':full_name' => $fullName,
        ':nickname' => $nickname,
        ':email' => $email,
        ':password' => $hashedPassword
    ]);

    // Automatically log them in after registering
    $_SESSION['user_id'] = $pdo->lastInsertId();
    $_SESSION['user_name'] = $nickname;
    
    header("Location: ../index.php?page=dashboard");
    exit;
}

// ==========================================
// 2. LOGIN LOGIC
// ==========================================
if ($action === 'login') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Find the user by email
    $stmt = $pdo->prepare("SELECT id, nickname, password_hash, is_active, system_role FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    // Verify user exists, is active, and password matches
    if ($user && $user['is_active'] == 1 && password_verify($password, $user['password_hash'])) {
        // Success! Create the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nickname'];
        $_SESSION['system_role'] = $user['system_role'];
        header("Location: ../index.php?page=dashboard");
        
        exit;
    } else {
        // Failed login
        header("Location: ../index.php?page=login&error=invalid");
        exit;
    }
}
?>