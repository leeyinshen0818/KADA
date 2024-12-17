<?php
// Basic Router
$uri = trim($_SERVER['REQUEST_URI'], '/');
$method = $_SERVER['REQUEST_METHOD'];

require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';
require_once '../app/core/Database.php';
require_once '../app/controllers/UserController.php';
require_once '../app/models/User.php';
require_once '../app/core/Autoload.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/models/Admin.php';

use App\Controllers\UserController;
use App\Controllers\AdminController;

$controller = new UserController();
$adminController = new AdminController();



if ($uri === '' && $method === 'GET') {
    $controller->index();
} elseif ($uri === 'register' && $method === 'GET') {
    $controller->register();
} elseif ($uri === 'store' && $method === 'POST') {
    $controller->store();
} elseif (preg_match('/edit\/(\d+)/', $uri, $matches) && $method === 'GET') {
    $controller->edit($matches[1]);

} else {
    http_response_code(404);
    echo "Page not found.";
}

