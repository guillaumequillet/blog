<?php
require_once('Controller.php');
require_once('model/CommentModel.php');

class CommentController extends Controller 
{
	public function __construct($episode_id) {
		$this->_model = new CommentModel();
		$this->_data = $this->_model->getComments($episode_id);
		$this->_view = 'view/comments.html.php';

		// $this->_model->addComment('Autre utilisateur', 'Ceci est un autre commentaire de test', 1);
	}
}