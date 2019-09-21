<?php
require_once('Controller.php');
require_once('model/CommentModel.php');

class CommentController extends Controller 
{
	public function __construct($episode_id) {
		$this->_model = new CommentModel();
		$this->_data = $this->_model->getComments($episode_id);
		$this->_view = 'view/comments.html.php';
	}
}