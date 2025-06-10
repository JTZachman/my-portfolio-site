<?php
session_start();

// Optional: check if logged in (basic check)
// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add New Post - Admin</title>
    <link rel="stylesheet" href="admin.css" />
</head>
<body>
    <h1>Add New Post</h1>
    
    <form action="add-post.php" method="post">
        <label>Title:</label><br>
        <input type="text" name="title" required><br><br>
        
        <label>Slug (optional):</label><br>
        <input type="text" name="slug"><br><br>
        
        <label>Content:</label><br>
        <textarea name="content" rows="10" cols="50" required></textarea><br><br>
        
        <label>Status:</label><br>
        <select name="status">
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select><br><br>
        
        <button type="submit">Publish Post</button>
    </form>
    
    <p><a href="dashboard.php">← Back to Dashboard</a></p>
</body>
</html>