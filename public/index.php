<?php
declare(strict_types=1);
require 'vendor/autoload.php';

use App\Controller\EpisodeController;
use App\Controller\CommentController;
use App\Controller\AuthController;
use App\Controller\AdminController;
use App\Tool\SuperglobalManager;

$superglobalManager = new SuperglobalManager();

session_start();

// if controller exists
if (isset($_GET['controller']) && class_exists("App\\Controller\\" . ucfirst($_GET['controller']) . 'Controller')) {
	// if admin is not logged in but admin controller is requested
	if ($_GET['controller'] === 'admin' && !$superglobalManager->hasSessionVariable('admin'))
	{
		$controller = new AuthController();
		$action = 'login';
		$param = 3;
		$controller->$action($param);
	} else {
		$className = "App\\Controller\\" . ucfirst($_GET['controller']) . 'Controller';
		$controller = new $className;
		// if action exists
		if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
			$action = $_GET['action'];
			$param = (isset($_GET['param'])) ? (int)$_GET['param'] : null;
			$controller->$action($param);
		}
	}
}

if (!isset($controller) || !isset($action)) {
	$controller = new EpisodeController();
	$controller->home();
}

/*
  reste le bug de la connexion à l'admin en direct, sans passer par AuthController
*/