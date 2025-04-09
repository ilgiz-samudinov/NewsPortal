<?php


// app/Controllers/AdminController.php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\NewsModel;

class AdminController extends Controller {
    private $newsModel;

    public function __construct() {
        $this->newsModel = new NewsModel();
    }

    // Страница админ-панели - список новостей с действиями
    public function index() {
        $newsList = $this->newsModel->getAllNews();  // Получаем все новости
        $csrfToken = $this->generateCSRFToken();  // Генерируем CSRF токен

        $this->view('admin/news_list', [
            'news' => $newsList,  // Передаем список новостей
            'csrf_token' => $csrfToken // Передаем CSRF токен
        ]);
    }

    // Генерация CSRF токена
    protected function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // Страница создания новости
    public function create() {
        $this->view('admin/create_news');  // Страница для добавления новости
    }

    // Сохранение новой новости
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Метод не разрешен";
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $shortContent = trim($_POST['short_content'] ?? '');
        $fullContent = trim($_POST['full_content'] ?? '');

        if (empty($title) || empty($shortContent) || empty($fullContent)) {
            echo "Ошибка: все поля должны быть заполнены";
            exit;
        }

        if ($this->newsModel->createNews($title, $shortContent, $fullContent)) {
            header("Location: /admin/news");
            exit;
        } else {
            echo "Ошибка: не удалось сохранить новость";
        }
    }

    // Страница редактирования новости
    public function edit($id) {
        $news = $this->newsModel->getNewsById($id);
        if (!$news) {
            http_response_code(404);
            echo "Ошибка: новость не найдена";
            exit;
        }

        $this->view('admin/edit_news', ['news' => $news]);
    }

    // Обновление новости
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Метод не разрешен";
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $shortContent = trim($_POST['short_content'] ?? '');
        $fullContent = trim($_POST['full_content'] ?? '');

        if (empty($title) || empty($shortContent) || empty($fullContent)) {
            echo "Ошибка: все поля должны быть заполнены";
            exit;
        }

        if ($this->newsModel->updateNews($id, $title, $shortContent, $fullContent)) {
            header("Location: /admin/news");
            exit;
        } else {
            echo "Ошибка: не удалось обновить новость";
        }
    }

    // Удаление новости
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Метод не разрешен";
            exit;
        }

        if ($this->newsModel->deleteNews($id)) {
            header("Location: /admin/news");
            exit;
        } else {
            echo "Ошибка: не удалось удалить новость";
        }
    }
}
