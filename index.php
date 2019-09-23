<?php
/*
	NOTICES / TODOS

	if you remove some episode, you MUST delete all the related comments as well !
*/
	
require_once('controller/EpisodeListController.php');
require_once('controller/EpisodeController.php');
require_once('controller/CommentController.php');

// some checks must be added
$action     = isset($_GET['action']) ? $_GET['action'] : 'episode';

$episode_id = isset($_GET['id']) ? $_GET['id'] : 1;
// we should check that this episode exists, and call a default one OR some 404 page if not present
if (!EpisodeModel::hasEpisode($episode_id)) {
	$episode_id = 1;
}

// creation of Menu List Controller object
$menuListController = new EpisodeListController();
$episodeListMenu = $menuListController->render();

// creation of Episode Content
$page_title = 'Billet simple pour l\'Alaska' . ' épisode ' . $episode_id;
$episodeController = new EpisodeController($episode_id);

$pageContent = $episodeController->render();

// comments
$commentController = new CommentController($episode_id);

// if some comment was submitted
if (isset($_POST['author']) and isset($_POST['message'])) {
	$commentController->addComment($episode_id, $_POST['author'], $_POST['message']);
}
$commentContent = $commentController->render();

require('view/template.html.php');