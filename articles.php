<?php
require_once __DIR__ . '/includes/db.php';

$page = $_GET['page'] ?? 1;
$perPage = 10;
$offset = ($page - 1) * $perPage;

$total = Database::query("SELECT COUNT(*) as count FROM articles")->fetch()['count'];
$pages = ceil($total / $perPage);

$articles = Database::query(
    "SELECT * FROM articles ORDER BY created_at DESC LIMIT :limit OFFSET :offset",
    [':limit' => $perPage, ':offset' => $offset]
)->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Articles</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        .btn { display: inline-block; background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-bottom: 20px; }
        .article { border-bottom: 1px solid #ddd; padding: 15px 0; }
        .article h2 { margin: 0 0 10px; }
        .article h2 a { color: #007bff; text-decoration: none; }
        .meta { color: #666; font-size: 14px; margin-bottom: 10px; }
        .pagination { margin-top: 20px; text-align: center; }
        .pagination a, .pagination span { display: inline-block; padding: 5px 10px; margin: 0 3px; border: 1px solid #ddd; text-decoration: none; }
        .current { background: #007bff; color: white; border-color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <a href="pages/add_article.php" class="btn">+ New Article</a>
        <h1>Articles</h1>
        <?php foreach ($articles as $article): ?>
            <div class="article">
                <h2><a href="pages/view_article.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></h2>
                <div class="meta">By <?= htmlspecialchars($article['author']) ?> | Views: <?= $article['views'] ?> | <?= $article['created_at'] ?></div>
                <div><?= htmlspecialchars(substr($article['content'], 0, 200)) ?>...</div>
            </div>
        <?php endforeach; ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="current"><?= $i ?></span>
                <?php else: ?>
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
