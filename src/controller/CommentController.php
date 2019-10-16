<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\EpisodeModel;
use App\Model\CommentModel;
use App\Tool\SuperglobalManager;

class CommentController extends Controller
{
    public function add(int $episodeId) : void {
        $this->model = new EpisodeModel($this->database);

        if ($this->model->episodeExists($episodeId)) {
            $this->model = new CommentModel($this->database);

            $superglobalManager = new SuperglobalManager();

            if ($superglobalManager->hasPostVariable('author') && $superglobalManager->hasPostVariable('content')) {
                $author  = $superglobalManager->findPostVariable('author');
                $content = $superglobalManager->findPostVariable('content');
                $this->model->addComment($author, $content, $episodeId);
            }
        }
        header('Location: index.php?controller=episode&action=show&param=' . $episodeId);
    }

    public function report(int $commentId) : void {
        $this->model = new CommentModel($this->database);
        $this->model->reportComment($commentId);
        header('Location: index.php?controller=episode&action=show&param=' 
            . $this->model->findEpisodeIdWithCommentId($commentId)); 
    }
}
