<?php
// app/Core/Database.php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private $connection;
    private $config;

    public function __construct() {
        $this->config = require dirname(__DIR__, 2) . '/config/database.php';
        $this->connect();
    }

    private function connect() {
        try {
            $dsn = "pgsql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['database']}";

            $this->connection = new PDO($dsn, $this->config['username'], $this->config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    // Защита от SQL-инъекций через подготовленные запросы
    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }
}