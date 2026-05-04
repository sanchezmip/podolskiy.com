<?php
require_once __DIR__ . '/../includes/db.php';

$id = $_GET['id'] ?? 0;
Database::query("UPDATE articles SET views = views + 1 WHERE id = ?", [$id]);
$article = Database::query("SELECT * FROM articles WHERE id = ?", [$id])->fetch();

if (!$article) {
    die("Article not found");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($article['title']) ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 8px; }
        .back { margin-bottom: 20px; display: inline-block; color: #007bff; text-decoration: none; }
        h1 { margin-top: 0; }
        .meta { color: #666; border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px; }
        .content { line-height: 1.6; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/articles.php" class="back">← Back to articles</a>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <div class="meta">By <?= htmlspecialchars($article['author']) ?> | Views: <?= $article['views'] ?> | <?= $article['created_at'] ?></div>
        <div class="content"><?= nl2br(htmlspecialchars($article['content'])) ?></div>
    </div>
</body>
</html>
