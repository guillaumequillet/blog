<?php
declare(strict_types=1);

require_once('src/controller/Controller.php');
require_once('src/model/CommentModel.php');

class CommentController extends Controller
{
	public function show(int $episodeId) {
		$this->_model = new CommentModel();
	}
}