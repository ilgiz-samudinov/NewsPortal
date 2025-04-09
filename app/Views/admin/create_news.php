<!DOCTYPE html>
<html>
<head>
    <title>Создание новости</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<div class="container">
    <h1>Создание новости</h1>
    <form action="/admin/news/store" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">

        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title" required>

        <label for="short_content">Краткое описание:</label>
        <textarea id="short_content" name="short_content" required></textarea>

        <label for="full_content">Полный текст:</label>
        <textarea id="full_content" name="full_content" required></textarea>

        <button type="submit">Опубликовать</button>
    </form>
</div>
</body>
</html>
