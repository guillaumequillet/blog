<?php
declare(strict_types=1);

require_once('src/controller/Controller.php');
require_once('src/model/EpisodeModel.php');
require_once('src/view/View.php');

class EpisodeController extends Controller
{
	public function show(int $episodeId) {
		$this->_model = new EpisodeModel();
		$this->_data = Array();

		$episodeData = $this->_model->getEpisode($episodeId);

		if ($episodeData === null) {
			$this->unfound();
		} else {
			$this->_data['episode'] = $episodeData;
			$this->_data['episodeList'] = $this->_model->getEpisodeTitles();
		
			// comments section
			$this->_model = new CommentModel();
			$this->_data['comments'] = $this->_model->getEpisodeComments($episodeId);

			$this->_view = new View('src/view/episodeView.php');
			$this->_view->render($this->_data);
		}
	}

	public function unfound() {
		$this->_view = new View('src/view/unfoundView.php');
		$this->_view->render(null);
	}
}