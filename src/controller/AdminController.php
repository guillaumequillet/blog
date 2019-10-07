<?php
declare(strict_types=1);

namespace App\Controller;

use App\Tool\SuperglobalManager;
use App\Model\UserModel;
use App\View\View;

session_start();

class AdminController extends Controller 
{
	private $superglobalManager;

	public function __construct() {
		parent::__construct();
		$this->superglobalManager = new SuperglobalManager();
		$this->data = [];

		if ($this->superglobalManager->hasSessionVariable('admin')) {
			$this->view->setTemplate('../templates/adminLayout.html.php');
		}

	}

	public function login(?int $param = null): void {
		// if admin is already logged in, we redirect to admin menu
		if ($this->superglobalManager->hasSessionVariable('admin')) {
			header('location: index.php?controller=admin&action=user');
		}

		$this->data['param'] = $param;
		$this->view->render('Admin Login', 'adminLoginView', $this->data);
	}	

	public function validateLogin(): void {
		// if admin is already logged in, we redirect to admin menu
		if ($this->superglobalManager->hasSessionVariable('admin')) {
			header('location: index.php?controller=admin&action=user');
		}
		else {
			$this->model = new UserModel($this->database);

			$username = $this->superglobalManager->findPostVariable('username');
			$password = $this->superglobalManager->findPostVariable('password');

			// if connexion is successful
			if ($this->model->validateLogin($username, $password)) {
				$this->superglobalManager->setSessionVariable('admin', 'logged');
				header('location: index.php?controller=admin&action=user');
			}
			else {
				header('location: index.php?controller=admin&action=login&param=0');
			}
		}
	}

	public function logout(): void {
		$this->superglobalManager->deleteSessionVariable('admin');
		header('location: index.php?controller=admin&action=login&param=1');
	}

	public function user(): void {
		// if admin is not already logged in, we redirect to login menu
		if (!$this->superglobalManager->hasSessionVariable('admin')) {
			header('location: index.php?controller=admin&action=login');
		}
		$this->view->render('Paramètres de connexion', 'adminUserView');
	}
}