<?php
$host = 'localhost';
$port = 5432;
$dbname = 'news_portal';
$username = 'postgres';
$password = 'postgres';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✅ Успешное подключение к базе данных!";
} catch (PDOException $e) {
    echo "❌ Ошибка подключения: " . $e->getMessage();
}
?>
