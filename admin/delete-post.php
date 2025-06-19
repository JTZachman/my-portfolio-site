<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid post ID.");
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
$success = $stmt->execute([$id]);

if ($success) {
    header("Location: dashboard.php?deleted=1");
    exit;
} else {
    echo "Error deleting post.";
}