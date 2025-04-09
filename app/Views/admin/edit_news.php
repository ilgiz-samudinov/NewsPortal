<!DOCTYPE html>
<html>
<head>
    <title>Редактирование новости</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<div class="container">
    <h1>Редактирование новости</h1>

    <?php if (!isset($news)): ?>
        <p>Ошибка: новость не найдена.</p>
    <?php else: ?>
        <form action="/admin/news/update/<?= htmlspecialchars($news['id']) ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">

            <label for="title">Заголовок:</label>
            <input type="text" id="title" name="title"
                   value="<?= htmlspecialchars($news['title']) ?>" required>

            <label for="short_content">Краткое описание:</label>
            <textarea id="short_content" name="short_content" required><?= htmlspecialchars($news['short_content']) ?></textarea>

            <label for="full_content">Полный текст:</label>
            <textarea id="full_content" name="full_content" required><?= htmlspecialchars($news['full_content']) ?></textarea>

            <button type="submit">Обновить новость</button>
        </form>
        <a href="/" class="back-link">Вернуться на главную</a>
    <?php endif; ?>
</div>
</body>
</html>
