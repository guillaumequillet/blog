<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\EpisodeModel;
use App\Model\CommentModel;
use App\Tool\SuperglobalManager;

class CommentController extends Controller
{
    public function add(int $episodeId) : void 
    {
        $this->superglobalManager = new SuperglobalManager();
        $token = $this->superglobalManager->findPostVariable('token');

        if (!$this->superglobalManager->checkToken($token)) {
            header('Location: index.php?controller=episode&action=home');
            exit();
        }

        $this->model = new EpisodeModel($this->database);

        if (!$this->model->episodeExists($episodeId)) {
            header('location: index.php?controller=episode&action=unfound');
            exit();
        }

        $this->model = new CommentModel($this->database);

        if ($this->superglobalManager->hasPostVariable('author') && $this->superglobalManager->hasPostVariable('content')) {
            $author = $this->superglobalManager->findPostVariable('author');
            $content = $this->superglobalManager->findPostVariable('content');
            $this->model->addComment($author, $content, $episodeId);
        }
        header('Location: index.php?controller=episode&action=show&param=' . $episodeId);
    }

    public function report(int $commentId) : void 
    {
        $this->model = new CommentModel($this->database);
        $this->model->reportComment($commentId);
        $episodeId = $this->model->findEpisodeIdWithCommentId($commentId);

        if (is_null($episodeId)) {
            header('Location: index.php?controller=episode&action=unfound');
            exit();
        }
        header('Location: index.php?controller=episode&action=show&param=' . $episodeId); 
    }
}
