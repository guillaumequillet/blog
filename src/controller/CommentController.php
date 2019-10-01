<?php
declare(strict_types=1);

require_once('src/controller/Controller.php');
require_once('src/model/CommentModel.php');

class CommentController extends Controller
{
	public function add(int $episodeId) {
		$this->model = new CommentModel();

		if (isset($_POST['author']) && isset($_POST['content'])) {
			$author  = htmlentities($_POST['author']);
			$content = htmlentities($_POST['content']);
			$this->model->addComment($author, $content, $episodeId);
		}
		header('Location: index.php?controller=episode&action=show&param=' . $episodeId);
	}

	public function report(int $commentId) {
		$this->model = new CommentModel();
		$this->model->reportComment($commentId);
		$episode = $this->model->getComment($commentId);
		header('Location: index.php?controller=episode&action=show&param=' . $episode['episode_id']);
	}
}