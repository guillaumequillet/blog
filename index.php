<?php
require_once('controller/EpisodeListController.php');
require_once('controller/EpisodeController.php');
require_once('controller/CommentController.php');

// some checks mus be added
$action  = isset($_GET['action']) ? $_GET['action'] : 'episode';
$episode = isset($_GET['id']) ? $_GET['id'] : 0;

// creation of Menu List Controller object
$menuListController = new EpisodeListController();
$episodeListMenu = $menuListController->render();

// creation of Episode Content
$page_title = 'Billet simple pour l\'Alaska' . ' épisode ' . $episode;
$episodeController = new EpisodeController($episode);
$pageContent = $episodeController->render();

// comments
$commentController = new CommentController($episode);
$commentContent = $commentController->render();

require('view/template.html.php');