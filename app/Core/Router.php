<?php
// app/Core/Router.php
namespace App\Core;

class Router {
    private $routes = [];

    public function __construct() {
        $this->routes = require dirname(__DIR__, 2) . '/config/routes.php';
    }

    public function dispatch($uri) {
        foreach ($this->routes as $route => $params) {
            $pattern = '#^' . $route . '$#';
            
            if (preg_match($pattern, $uri, $matches)) {
                $controllerName = "App\\Controllers\\" . $params['controller'];
                $methodName = $params['method'];
                
                // Удаляем первый элемент массива (полное совпадение)
                array_shift($matches);
                
                $controller = new $controllerName();
                
                // Вызываем метод контроллера с параметрами
                call_user_func_array([$controller, $methodName], $matches);
                return true;
            }
        }
        
        // Обработка 404 ошибки
        http_response_code(404);
        echo "Страница не найдена";
        return false;
    }
}