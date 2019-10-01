<?php
declare(strict_types=1);

require_once('src/controller/Controller.php');
require_once('src/model/EpisodeModel.php');
require_once('src/view/View.php');

class EpisodeController extends Controller
{
	public function show(?int $episodeId) : void {
		$this->model = new EpisodeModel($this->database);
		$this->data = [];

		if (!is_null($episodeId)) {
			$episodeData = $this->model->findEpisode($episodeId);
		}

		if (!isset($episodeData) || is_null($episodeData)) {
			header('Location: index.php?controller=episode&action=unfound');
		} else {
			// episode section
			$this->data['episode'] = $episodeData;
			$this->data['episodeList'] = $this->model->findEpisodeTitles();
		
			// comments section
			$this->model = new CommentModel($this->database);
			$this->data['comments'] = $this->model->findEpisodeComments($episodeId);
			$this->view->render("Episode n° " . $episodeId, 'episodeView', $this->data);
		}
	}

	public function home() : void {
		$this->view->render("Accueil", 'homeView');
	}

	public function unfound() : void {
		$this->view->render("Episode non trouvé", 'unfoundView');
	}
}