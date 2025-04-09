<?php
// app/Core/Controller.php
namespace App\Core;

abstract class Controller {
    protected function view($viewName, $data = []) {
        extract($data);
        require dirname(__DIR__) . "/Views/{$viewName}.php";
    }

    // Защита от CSRF
    protected function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}