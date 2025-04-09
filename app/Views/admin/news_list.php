<!-- app/Views/admin/news_list.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ панель - Новости</title>
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        /* Пример простых стилей для кнопок и блока действий */
        .admin-actions {
            margin-top: 10px;
        }
        .admin-actions .button {
            margin-right: 5px;
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .admin-actions .button:hover {
            background-color: #0056b3;
        }
        .add-button {
            display: inline-block;
            margin-bottom: 15px;
            padding: 7px 15px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }
        .add-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Новости</h1>

    <!-- Кнопка для добавления новой новости -->
    <a href="/admin/news/create" class="add-button">Добавить новость</a>

    <?php if (!empty($news)): ?>
        <?php foreach ($news as $article): ?>
            <article>
                <h2>
                    <a href="/news/<?= $article['id'] ?>">
                        <?= htmlspecialchars($article['title']) ?>
                    </a>
                </h2>
                <p><?= htmlspecialchars($article['short_content']) ?></p>
                <small>Опубликовано: <?= date('d.m.Y', strtotime($article['created_at'])) ?></small>

                <div class="admin-actions">
                    <!-- Кнопка редактирования -->
                    <a href="/admin/news/edit/<?= $article['id'] ?>" class="button">Редактировать</a>

                    <!-- Форма удаления новости -->
                    <form action="/admin/news/delete/<?= $article['id'] ?>" method="POST" style="display:inline;">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">
                        <button type="submit" class="button">Удалить</button>
                    </form>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Новостей пока нет.</p>
    <?php endif; ?>
</div>
</body>
</html>
