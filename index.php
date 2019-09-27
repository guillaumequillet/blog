<?php
declare(strict_types=1);

require_once('src/controller/EpisodeController.php');
require_once('src/controller/CommentController.php');

// if controller exists
if (isset($_GET['controller']) && class_exists(ucfirst($_GET['controller']) . 'Controller')) {
	$className = ucfirst($_GET['controller']) . 'Controller';
	$controller = new $className;
	
	// if action exists
	if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
		$action = $_GET['action'];
		$param = (isset($_GET['param'])) ? (int)$_GET['param'] : null;
		$controller->$action($param);
	}
}

if (!isset($controller) || !isset($action)) {
	$controller = new EpisodeController();
	$controller->home();
}

