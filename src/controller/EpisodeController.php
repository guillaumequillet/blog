<?php
declare(strict_types=1);

require_once('src/controller/Controller.php');
require_once('src/model/EpisodeModel.php');
require_once('src/view/View.php');

class EpisodeController extends Controller
{
	public function show(?int $episodeId) : void {
		$this->model = new EpisodeModel();
		$this->data = Array();

		if (!is_null($episodeId)) {
			$episodeData = $this->model->getEpisode($episodeId);
		}

		if (!isset($episodeData) || is_null($episodeData)) {
			$this->unfound();
		} else {
			$this->data['episode'] = $episodeData;
			$this->data['episodeList'] = $this->model->getEpisodeTitles();
		
			// comments section
			$this->model = new CommentModel();
			$this->data['comments'] = $this->model->getEpisodeComments($episodeId);

			$this->view = new View('src/view/episodeView.php');
			$this->view->render("Episode n° " . $episodeId, $this->data);
		}
	}

	public function home() {
		$this->view = new View('src/view/homeView.php');
		$this->view->render("Accueil", null);
	}

	public function unfound() {
		$this->view = new View('src/view/unfoundView.php');
		$this->view->render("Episode non trouvé", null);
	}
}