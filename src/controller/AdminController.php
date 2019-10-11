<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;
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

	public function comments(): void {
		$this->view->render('Modération des commentaires', 'adminCommentsView');
	}

	public function episodes(): void {
		$this->view->render('Gestion des épisodes', 'adminEpisodesView');
	}
}
