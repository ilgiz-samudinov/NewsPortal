    <?php
    // public/index.php
    session_start();

    require_once dirname(__DIR__) . '/vendor/autoload.php';

    use App\Core\Router;

    // Обработка URI
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Создание и диспетчеризация роутера
    $router = new Router();
    $router->dispatch($uri);