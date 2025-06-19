<?php include('includes/header.php'); ?>
<?php include('includes/nav.php'); ?>
<?php
require_once 'includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid post ID.");
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT title, content, created_at FROM blog_posts WHERE id = ? AND status = 'published'");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post not found or not published.");
}
?>

<div class="post-container">
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p class="meta">Published on <?= date('F j, Y', strtotime($post['created_at'])) ?></p>
    <div class="post-content">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>
    <p><a href="blog.php">← Back to Blog</a></p>
</div>
<?php include('includes/footer.php'); ?>