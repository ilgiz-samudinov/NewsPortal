<?php
// app/Controllers/NewsController.php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\NewsModel;

class NewsController extends Controller {
    private $newsModel;

    public function __construct() {
        $this->newsModel = new NewsModel();
    }

    // Список новостей
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $news = $this->newsModel->getAllNews($limit, $offset) ?? [];

        $this->view('news/index', [
            'news' => $news,
            'page' => $page
        ]);
    }

    // Просмотр одной новости
    public function single($id) {
        $news = $this->newsModel->getNewsById($id);

        if (!$news) {
            http_response_code(404);
            echo "Новость не найдена";
            exit;
        }

        $this->view('news/single', ['news' => $news]);
    }
}
