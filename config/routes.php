    <?php
    // config/routes.php
    return [
        '/' => ['controller' => 'NewsController', 'method' => 'index'],
        '/news/(\d+)' => ['controller' => 'NewsController', 'method' => 'single'],

        // Административные маршруты
        '/admin/news' => ['controller' => 'AdminController', 'method' => 'index'],
        '/admin/news/create' => ['controller' => 'AdminController', 'method' => 'create'],
        '/admin/news/store' => ['controller' => 'AdminController', 'method' => 'store'],
        '/admin/news/edit/(\d+)' => ['controller' => 'AdminController', 'method' => 'edit'],
        '/admin/news/update/(\d+)' => ['controller' => 'AdminController', 'method' => 'update'],
        '/admin/news/delete/(\d+)' => ['controller' => 'AdminController', 'method' => 'delete', 'method_type' => 'POST'],
    ];
