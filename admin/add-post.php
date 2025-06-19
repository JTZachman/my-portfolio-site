<?php
session_start();

// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// DB config
require_once '../includes/db.php';

// Sanitize and assign variables
$title   = trim($_POST['title'] ?? '');
$slug    = trim($_POST['slug'] ?? '');
$excerpt = trim($_POST['excerpt'] ?? '');
$content = trim($_POST['content'] ?? '');
$status  = $_POST['status'] ?? 'draft';
$author  = $_SESSION['username'] ?? 'Anonymous'; // adjust based on how your session is set

// Auto-generate slug if empty
if (empty($slug)) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
}

// Validate required fields
if (empty($title) || empty($content)) {
    die("Title and content are required.");
}

// Prepare the SQL insert
$sql = "INSERT INTO blog_posts (title, slug, excerpt, content, status, author)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
try {
    $stmt->execute([$title, $slug, $excerpt, $content, $status, $author]);
    header("Location: dashboard.php?success=post-added");
    exit;
} catch (PDOException $e) {
    die("Error inserting post: " . $e->getMessage());
}
?>