<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;
use App\Model\CommentModel;
use App\Model\EpisodeModel;
use App\View\View;

class AdminController extends Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->data = [];
        $this->view->setTemplate('../templates/adminLayout.html.php');
    }

    public function user(?int $param = null): void 
    {
        $this->data['token'] = $this->token->generateString();
        $this->data['param'] = $param;
        $this->view->render('Paramètres de connexion', 'adminUserView', $this->data);
    }

    public function userValidate(): void 
    {
        if (!$this->token->check()) {
            header('location: index.php?controller=auth&action=logout');
            exit();         
        }

        $this->model = new UserModel($this->database);

        // changing Username
        $oldUsername = $this->superglobalManager->findPostVariable('oldUsername');
        $newUsername = $this->superglobalManager->findPostVariable('newUsername');
        $newUsernameConfirm = $this->superglobalManager->findPostVariable('newUsernameConfirm');

        if (is_null($oldUsername) || is_null($newUsername) || is_null($newUsernameConfirm)) {
            header('location: index.php?controller=admin&action=user&param=0');
            exit();
        }        
        $validUsername = $this->model->validUsername($oldUsername);

        if ($validUsername & ($newUsername === $newUsernameConfirm) & !is_null($newUsername)) {
            $this->model->setUsername($newUsername);
            header('location: index.php?controller=admin&action=user&param=1');
            exit();
        }

        // changing password
        $oldPassword = $this->superglobalManager->findPostVariable('oldPassword');
        $newPassword = $this->superglobalManager->findPostVariable('newPassword');
        $newPasswordConfirm = $this->superglobalManager->findPostVariable('newPasswordConfirm');

        if (is_null($oldPassword) || is_null($newPassword) || is_null($newPasswordConfirm)) {
            header('location: index.php?controller=admin&action=user&param=0');
            exit();
        }
        $validPassword = $this->model->validPassword($oldPassword);

        if ($validPassword & ($newPassword === $newPasswordConfirm) & !is_null($newPassword)) {
            $this->model->setPassword($newPassword);
            header('location: index.php?controller=admin&action=user&param=1');
            exit();
        }

        // if there was an issue
        header('location: index.php?controller=admin&action=user&param=0');
    }

    public function comments(?int $reportedOnly = 0): void 
    {
        $this->model = new CommentModel($this->database);
        $this->data['comments'] = ((bool)$reportedOnly) ? $this->model->findReportedComments() : $this->model->findAllComments();
        $this->data['param'] = is_null($reportedOnly) ? 0 : $reportedOnly;
        $this->view->render('Modération des commentaires', 'adminCommentsView', $this->data);
    }

    public function deleteReportedComment(int $id): void 
    {
        $this->deleteComment($id);
        header('location: index.php?controller=admin&action=comments&param=1');
    }

    public function approveReportedComment(int $id): void 
    {
        $this->approveComment($id);
        header('location: index.php?controller=admin&action=comments&param=1');
    }

    public function deleteComment(int $id): void 
    {
        $this->model = new CommentModel($this->database);
        $this->model->deleteComment($id);
        header('location: index.php?controller=admin&action=comments&param=0');
    }

    public function approveComment(int $id): void 
    {
        $this->model = new CommentModel($this->database);
        $this->model->approveComment($id);
        header('location: index.php?controller=admin&action=comments&param=0');
    }

    public function episodes(): void 
    {
        $this->model = new EpisodeModel($this->database);
        $this->data['episodeData'] = $this->model->findEpisodeTitles();
        $this->view->render('Gestion des épisodes', 'adminEpisodesView', $this->data);
    }

    public function editEpisode(?int $id = null): void 
    {
        $this->model = new EpisodeModel($this->database);

        if (!is_null($id)) {
            $episode = $this->model->findEpisode($id);
        }

        if (isset($episode) && !is_null($episode)) {
            $this->data['episode'] = $episode;
            $this->data['episode']['content'] = html_entity_decode($this->data['episode']['content']);
        }

        $this->data['token'] = $this->token->generateString();
        $this->view->render('Gestion de l\'épisode', 'adminEpisodeEditView', $this->data);
    }

    public function updateEpisode(): void 
    {
        if (!$this->token->check()) {
            header('location: index.php?controller=auth&action=logout');
            exit();         
        }

        $this->model = new EpisodeModel($this->database);

        if ($this->superglobalManager->hasPostVariable('episodeTitle')
            && $this->superglobalManager->hasPostVariable('episodeContent')) {
            $id = $this->superglobalManager->findPostVariable('episodeId');
            $title = $this->superglobalManager->findPostVariable('episodeTitle');
            $content = $this->superglobalManager->findPostVariable('episodeContent');
            $published = $this->superglobalManager->hasPostVariable('published');

            switch ($id) {
                case '': // if no id is set : new episode
                    $this->model->addEpisode($title, $content, (int)$published);
                    break;
                
                default: // update if id is set
                    $this->model->editEpisode((int)$id, $title, $content, (int)$published);
                    break;
            }
        }
        header('location: index.php?controller=admin&action=episodes');
    }

    public function previewEpisode(?int $episodeId) : void 
    {
        $this->view->setTemplate('../templates/layout.html.php');
        $this->model = new EpisodeModel($this->database);
        $this->data = [];

        if (!is_null($episodeId)) {
            $episodeData = $this->model->findEpisode($episodeId);
        }

        if (!isset($episodeData) || is_null($episodeData) || is_null($episodeId)) {
            header('Location: index.php?controller=episode&action=unfound');
            exit();
        }
        
        // episode section
        $this->data['episode'] = $episodeData;
        $this->data['episode']['content'] = html_entity_decode($this->data['episode']['content']);
        $this->data['episodeList'] = $this->model->findEpisodeTitles();
    
        // comments section
        $this->model = new CommentModel($this->database);
        $this->data['comments'] = $this->model->findEpisodeComments($episodeId);
        $this->data['token'] = $this->token->generateString();

        $this->view->render("[PREVIEW] Episode n° " . $episodeId, 'episodeView', $this->data);
    }

    public function deleteEpisode(int $id): void 
    {
        // delete related comments
        $this->model = new CommentModel($this->database);
        $this->model->deleteEpisodeComments($id);
        
        // delete episode
        $this->model = new EpisodeModel($this->database);
        $this->model->deleteEpisode($id);

        header('location: index.php?controller=admin&action=episodes');
    }
}
