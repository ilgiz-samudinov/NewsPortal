<!-- app/Views/news/single.php -->
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($news['title']) ?></title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="container">
        <article>
            <h1><?= htmlspecialchars($news['title']) ?></h1>
            <div class="content">
                <?= htmlspecialchars($news['full_content']) ?>
            </div>
            <small>Опубликовано: <?= date('d.m.Y H:i', strtotime($news['created_at'])) ?></small>
        </article>
        <a href="/">Вернуться к списку новостей</a>
    </div>
</body>
</html>