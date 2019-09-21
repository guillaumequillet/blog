<?php
require_once('controller/EpisodeListController.php');

// some checks mus be added
$action  = isset($_GET['action']) ? $_GET['action'] : 'episode';
$episode = isset($_GET['id']) ? $_GET['id'] : 0;

// creation of Menu List Controller object
$menuListController = new EpisodeListController();
$episodeListMenu = $menuListController->render();

// creation of Episode Content
$page_title = 'Billet simple pour l\'Alaska' . ' épisode ' . $episode;


require('view/template.html.php');