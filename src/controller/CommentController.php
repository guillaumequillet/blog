<?php
declare(strict_types=1);

require_once('src/controller/Controller.php');
require_once('src/model/CommentModel.php');
require_once('public/SuperglobalManager.php');

class CommentController extends Controller
{
	public function add(int $episodeId) : void {
		$this->model = new CommentModel();
		$superglobalManager = new SuperglobalManager();

		if ($superglobalManager->hasPostVariable('author') && $superglobalManager->hasPostVariable('content')) {
			$author  = $superglobalManager->findPostVariable('author');
			$content = $superglobalManager->findPostVariable('content');
			$this->model->addComment($author, $content, $episodeId);
		}
		header('Location: index.php?controller=episode&action=show&param=' . $episodeId);
	}

	public function report(int $commentId) : void {
		$this->model = new CommentModel();
		$this->model->reportComment($commentId);
		$episode = $this->model->findComment($commentId);
		header('Location: index.php?controller=episode&action=show&param=' . $episode['episode_id']);
	}
}