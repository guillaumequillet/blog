<?php
require_once('Controller.php');

class EpisodeController extends Controller
{
	public function __construct($id) {
		$this->_model = new EpisodeModel();
		$this->_data = $this->_model->getEpisode($id);
		$this->_view = 'view/episode.html.php';
	}
}