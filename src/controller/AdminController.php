<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;
use App\Model\CommentModel;
use App\Model\EpisodeModel;
use App\View\View;
use App\Tool\Superglobalmanager;

class AdminController extends Controller 
{
	public function __construct() {
		parent::__construct();
		$this->data = [];
		$this->view->setTemplate('../templates/adminLayout.html.php');
	}

	public function user(?int $param = null): void {
		$this->data['param'] = $param;
		$this->view->render('Paramètres de connexion', 'adminUserView', $this->data);
	}

	public function userValidate(): void {
		$this->superglobalmanager = new Superglobalmanager();
		$this->model = new UserModel($this->database);

		// changing Username
		if ($this->superglobalmanager->hasPostVariable('oldUsername') && $this->superglobalmanager->hasPostVariable('newUsername')	&& $this->superglobalmanager->hasPostVariable('newUsernameConfirm')	&& $this->superglobalmanager->findPostVariable('newUsername') === $this->superglobalmanager->findPostVariable('newUsernameConfirm')) {
			if ($this->model->validUsername($this->superglobalmanager->findPostVariable('oldUsername'))) {
				$this->model->setUsername($this->superglobalmanager->findPostVariable('newUsername'));
				header('location: index.php?controller=admin&action=user&param=1');
				exit();
			}
		}

		// changing password
		if ($this->superglobalmanager->hasPostVariable('oldPassword') && $this->superglobalmanager->hasPostVariable('newPassword')	&& $this->superglobalmanager->hasPostVariable('newPasswordConfirm')	&& $this->superglobalmanager->findPostVariable('newPassword') === $this->superglobalmanager->findPostVariable('newPasswordConfirm')) {
			if ($this->model->validPassword($this->superglobalmanager->findPostVariable('oldPassword'))) {
				$this->model->setPassword($this->superglobalmanager->findPostVariable('newPassword'));
				header('location: index.php?controller=admin&action=user&param=1');
				exit();
			}
		}

		// if there was an issue
		header('location: index.php?controller=admin&action=user&param=0');
	}

	public function comments(?int $reportedOnly = 0): void {
		$this->model = new CommentModel($this->database);
		$this->data['comments'] = ((bool)$reportedOnly) ? $this->model->findReportedComments() : $this->model->findAllComments();
		$this->data['param'] = is_null($reportedOnly) ? 0 : $reportedOnly;
		$this->view->render('Modération des commentaires', 'adminCommentsView', $this->data);
	}

	public function deleteReportedComment(int $id): void {
		$this->deleteComment($id);
		header('location: index.php?controller=admin&action=comments&param=1');
	}

	public function approveReportedComment(int $id): void {
		$this->approveComment($id);
		header('location: index.php?controller=admin&action=comments&param=1');
	}

	public function deleteComment(int $id): void {
		$this->model = new CommentModel($this->database);
		$this->model->deleteComment($id);
		header('location: index.php?controller=admin&action=comments&param=0');
	}

	public function approveComment(int $id): void {
		$this->model = new CommentModel($this->database);
		$this->model->approveComment($id);
		header('location: index.php?controller=admin&action=comments&param=0');
	}

	public function episodes(): void {
		$this->model = new EpisodeModel($this->database);
		$this->data['episodeData'] = $this->model->findEpisodeTitles();
		$this->view->render('Gestion des épisodes', 'adminEpisodesView', $this->data);
	}

	public function editEpisode(?int $id = null): void {

	}

	public function deleteEpisode(int $id): void {
		$this->model = new EpisodeModel($this->database);
		$this->model->deleteEpisode($id);
		header('location: index.php?controller=admin&action=episodes');
	}
}
