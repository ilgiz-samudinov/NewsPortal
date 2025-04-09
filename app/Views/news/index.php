<!DOCTYPE html>
<html>
<head>
    <title>Новости</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<div class="container">
    <h1>Последние новости</h1>
    <?php if (!empty($news)): ?>
        <?php foreach ($news as $article): ?>
            <article>
                <h2><a href="/news/<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></h2>
                <p><?= htmlspecialchars($article['short_content']) ?></p>
                <small>Опубликовано: <?= date('d.m.Y', strtotime($article['created_at'])) ?></small>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Новостей пока нет.</p>
    <?php endif; ?>
</div>
</body>
</html>
