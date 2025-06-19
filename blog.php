<?php include('includes/header.php'); ?>
<?php include('includes/nav.php'); ?>
<?php
require_once 'includes/db.php';

// Fetch all published posts
$stmt = $pdo->prepare("SELECT id, title, slug, excerpt, created_at FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="blog-container">
    <h1>Blog</h1>

    <?php if (count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
            <article class="blog-post">
                <h2>
                    <a href="post.php?id=<?= $post['id'] ?>">
                        <?= htmlspecialchars($post['title']) ?>
                    </a>
                </h2>
                <p class="meta">Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?></p>
                <p><?= nl2br(htmlspecialchars($post['excerpt'])) ?></p>
                <p><a href="post.php?id=<?= $post['id'] ?>">Read More →</a></p>
                <hr>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No blog posts found.</p>
    <?php endif; ?>
</div>
<?php include('includes/footer.php'); ?>