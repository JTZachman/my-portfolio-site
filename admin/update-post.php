<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';

// Sanitize and validate inputs
$id       = $_POST['id'] ?? null;
$title    = trim($_POST['title'] ?? '');
$slug     = trim($_POST['slug'] ?? '');
$excerpt  = trim($_POST['excerpt'] ?? '');
$content  = trim($_POST['content'] ?? '');
$status   = $_POST['status'] ?? 'draft';

if (!$id || !is_numeric($id)) {
    die("Invalid post ID.");
}

if (empty($title) || empty($content)) {
    die("Title and content are required.");
}

// If slug is empty, auto-generate one from title
if (empty($slug)) {
    $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $title));
    $slug = trim($slug, '-');
}

// Update the post
$stmt = $pdo->prepare("
    UPDATE blog_posts 
    SET title = ?, slug = ?, excerpt = ?, content = ?, status = ?, updated_at = NOW() 
    WHERE id = ?
");

$success = $stmt->execute([
    $title,
    $slug,
    $excerpt,
    $content,
    $status,
    $id
]);

if ($success) {
    header("Location: dashboard.php?updated=1");
    exit;
} else {
    echo "Error updating post.";
}