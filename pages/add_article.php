<?php
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Database::query(
        "INSERT INTO articles (title, content, author, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())",
        [$_POST['title'], $_POST['content'], $_POST['author'] ?? 'Anonymous']
    );
    header('Location: /articles.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Article</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; }
        textarea { min-height: 300px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Article</h1>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" required>
            <input type="text" name="author" placeholder="Author" value="Anonymous">
            <textarea name="content" placeholder="Content" required></textarea>
            <button type="submit">Publish</button>
        </form>
    </div>
</body>
</html>
