<?php
require_once '../lib/Session.php';

Session::start();

// Routing setup
$requestUri = $_SERVER['REQUEST_URI'];
$uriParts = explode('/', trim($requestUri, '/'));

$controllerName = ucfirst($uriParts[0] ?? 'Login') . 'Controller';
$action = $uriParts[1] ?? 'showLoginForm';

$controllerPath = '../controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controller = new $controllerName();

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        require '../views/errors/error_404.php';
    }
} else {
    require '../views/errors/error_404.php';
}
