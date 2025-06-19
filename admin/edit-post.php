<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../includes/db.php';

$post_id = $_GET['id'] ?? null;
if (!$post_id || !is_numeric($post_id)) {
    die("Invalid post ID.");
}

// Fetch post from DB
$stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Post - Admin</title>
    <link rel="stylesheet" href="admin.css" />
</head>
<body>
    <h1>Edit Post</h1>

    <form action="update-post.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">

        <label>Title:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>

        <label>Slug:</label><br>
        <input type="text" name="slug" value="<?= htmlspecialchars($post['slug']) ?>"><br><br>

        <label>Excerpt:</label><br>
        <textarea name="excerpt" rows="4" cols="50"><?= htmlspecialchars($post['excerpt']) ?></textarea><br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="10" cols="50" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="published" <?= $post['status'] === 'published' ? 'selected' : '' ?>>Published</option>
            <option value="draft" <?= $post['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
        </select><br><br>

        <button type="submit">Update Post</button>
    </form>

    <hr>

    <a href="delete-post.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure you want to delete this post?');">🗑️ Delete Post</a>
    

    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>