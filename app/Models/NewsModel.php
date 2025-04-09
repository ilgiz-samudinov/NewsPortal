<?php
// app/Models/NewsModel.php
namespace App\Models;

use App\Core\Database;
use PDO;

class NewsModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Получение всех новостей
    public function getAllNews($limit = 10, $offset = 0) {
        $stmt = $this->db->prepare("
            SELECT id, title, short_content, created_at 
            FROM news 
            ORDER BY created_at DESC 
            LIMIT :limit OFFSET :offset
        ");
        
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Получение одной новости по ID
    public function getNewsById($id) {
        $stmt = $this->db->prepare("
            SELECT * FROM news 
            WHERE id = :id
        ");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    // Создание новости
    public function createNews($title, $short_content, $full_content) {
        $stmt = $this->db->prepare("
            INSERT INTO news (title, short_content, full_content, created_at) 
            VALUES (:title, :short_content, :full_content, NOW())
        ");
        
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':short_content', $short_content);
        $stmt->bindValue(':full_content', $full_content);
        
        return $stmt->execute();
    }

    // Обновление новости
    public function updateNews($id, $title, $short_content, $full_content) {
        $stmt = $this->db->prepare("
            UPDATE news 
            SET title = :title, 
                short_content = :short_content, 
                full_content = :full_content 
            WHERE id = :id
        ");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':short_content', $short_content);
        $stmt->bindValue(':full_content', $full_content);
        
        return $stmt->execute();
    }

    // Удаление новости
    public function deleteNews($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}