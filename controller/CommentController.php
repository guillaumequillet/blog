<?php
require_once('Controller.php');
require_once('model/CommentModel.php');

class CommentController extends Controller 
{
	public function __construct($episode_id) {
		$this->_model = new CommentModel();
		$this->_data = $this->_model->getEpisodeComments($episode_id);
		$this->_view = 'view/comments.html.php';
	}

	public function addComment($episode_id, $author, $content) {
		$this->_model->addComment(htmlentities($author), htmlentities($content), $episode_id); 
		// update data to get the last comment
		$this->_data = $this->_model->getEpisodeComments($episode_id);
	}
}