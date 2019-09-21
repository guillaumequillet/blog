<?php
require_once('Controller.php');
require_once('model/EpisodeModel.php');

class EpisodeListController extends Controller
{
	public function __construct() {
		$this->_model = new EpisodeModel();
		$this->_data = $this->_model->getEpisodeTitles();
		$this->_view = 'view/episodeList.html.php';
	}
}