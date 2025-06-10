<?php
session_start();
require_once('../includes/db.php'); // Adjust path if needed

// Check if logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Get and sanitize form data
$title = trim($_POST['title']);
$slug = trim($_POST['slug']);
$content = trim($_POST['content']);
$status = $_POST['status'];
$created_at = date('Y-m-d H:i:s');

// Auto-generate slug if empty
if (empty($slug)) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
}

// Insert into DB
try {
    $stmt = $pdo->prepare("INSERT INTO posts (title, slug, content, status, created_at) VALUES (:title, :slug, :content, :status, :created_at)");
    
    $stmt->execute([
        ':title'      => $title,
        ':slug'       => $slug,
        ':content'    => $content,
        ':status'     => $status,
        ':created_at' => $created_at
    ]);

    // Redirect back to dashboard
    header('Location: dashboard.php');
    exit();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>