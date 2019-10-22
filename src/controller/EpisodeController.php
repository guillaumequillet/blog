<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\EpisodeModel;
use App\Model\CommentModel;

class EpisodeController extends Controller
{
    public function show(?int $episodeId) : void 
    {
        $this->model = new EpisodeModel($this->database);
        $this->data = [];

        if (!is_null($episodeId)) {
            $episodeData = $this->model->findPublishedEpisode($episodeId);
        }

        if (!isset($episodeData) || is_null($episodeData) || is_null($episodeId)) {
            header('Location: index.php?controller=episode&action=unfound');
            exit();
        }
        
        // episode section
        $this->data['episode'] = $episodeData;
        $this->data['episode']['content'] = html_entity_decode($this->data['episode']['content']);
        $this->data['episodeList'] = $this->model->findPublishedEpisodeTitles();
    
        // comments section
        $this->model = new CommentModel($this->database);
        $this->data['comments'] = $this->model->findEpisodeComments($episodeId);
        $this->data['token'] = $this->token->generateString();

        $this->view->render("Episode n° " . $episodeId, 'episodeView', $this->data);
    }

    public function showList(?int $page = 0) : void 
    {
        $episodesPerPage = 3;
        $excerptSize = 200;

        if (is_null($page)) {
            $page = 1;
        }

        $this->model = new EpisodeModel($this->database);
        $this->data = [];

        $this->data['episodeList'] = $this->model->findEpisodeExcerpts($page, $episodesPerPage);
        if (empty($this->data['episodeList'])) {
            header('Location: index.php?controller=episode&action=unfound');
            exit();
        }

        $this->data['episodeExcerptsList'] = [];

        foreach ($this->data['episodeList'] as $episode) {
            $this->data['episodeExcerptsList'][] = [
                'id' => $episode['id'],
                'title' => $episode['title'],
                'contentExcerpt' => substr(strip_tags(html_entity_decode($episode['content'])), 0, $excerptSize)
            ];    
        }

        $this->data['currentPage'] = $page;

        if ($this->data['currentPage'] > 1) {
            $this->data['previousPage'] = $this->data['currentPage'] - 1;
        }

        $episodeCount = $this->model->findPublishedEpisodeCount();
        $maxPage = (int)(ceil($episodeCount / $episodesPerPage));

        if ($this->data['currentPage'] < $maxPage) {
            $this->data['nextPage'] = $this->data['currentPage'] + 1;
        }

        $this->view->render('Episode Liste', 'episodeListView', $this->data);
    }

    public function home() : void 
    {
        $this->view->render('Accueil', 'homeView');
    }

    public function unfound() : void 
    {
        $this->view->render('Episode non trouvé', 'unfoundView');
    }
}
