<?php
declare(strict_types=1);

require_once('src/controller/Controller.php');
require_once('src/model/EpisodeModel.php');
require_once('src/view/View.php');

class EpisodeController extends Controller
{
	public function show(int $episodeId) {
		$this->_model = new EpisodeModel();
		$this->_data = $this->_model->getEpisode($episodeId);
		$this->_view = new View('src/view/episodeView.php');
		$this->_view->render($this->_data);
	}
}