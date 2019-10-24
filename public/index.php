<?php
declare(strict_types=1);
require '../vendor/autoload.php';

use App\Controller\EpisodeController;
use App\Controller\CommentController;
use App\Controller\AuthController;
use App\Controller\AdminController;
use App\Tool\SuperglobalManager;

$superglobalManager = new SuperglobalManager();

session_start();

// if controller exists
if ($superglobalManager->hasGetVariable('controller') && class_exists("App\\Controller\\" . ucfirst($_GET['controller']) . 'Controller')) {
    // if admin is not logged in but admin controller is requested
    if ($superglobalManager->findGetVariable('controller') === 'admin' && !$superglobalManager->hasSessionVariable('admin')) {
        $controller = new AuthController();
        $action = 'login';
        $param = 3;
        $controller->$action($param);
        exit();
    } 

    $className = "App\\Controller\\" . ucfirst($_GET['controller']) . 'Controller';
    $controller = new $className;
    // if action exists
    if ($superglobalManager->hasGetVariable('action') && method_exists($controller, $_GET['action'])) {
        $action = $superglobalManager->findGetVariable('action');
        $param = $superglobalManager->hasGetVariable('param') ? (int)$superglobalManager->findGetVariable('param') : null;
        $controller->$action($param);
        exit();
    }
}

if (!isset($controller) || !isset($action)) {
    $controller = new EpisodeController();
    $controller->home();
}
