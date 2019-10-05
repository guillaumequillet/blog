<?php
declare(strict_types=1);

namespace App\Controller;

use App\Tool\SuperglobalManager;
use App\Model\UserModel;

session_start();

class AdminController extends Controller 
{
	private $superglobalManager;

	public function __construct() {
		parent::__construct();
		$this->superglobalManager = new SuperglobalManager();
		$this->data = [];
	}

	public function login(?int $param = null): void {
		// if admin is already logged in, we redirect to admin menu
		if ($this->superglobalManager->hasSessionVariable('admin')) {
			header('location: index.php?controller=admin&action=menu');
		}

		$this->data['param'] = $param;
		$this->view->render('Admin Login', 'adminLoginView', $this->data);
	}	

	public function validateLogin(): void {
		// if admin is already logged in, we redirect to admin menu
		if ($this->superglobalManager->hasSessionVariable('admin')) {
			header('location: index.php?controller=admin&action=menu');
		}
		else {
			$this->model = new UserModel($this->database);

			$username = $this->superglobalManager->findPostVariable('username');
			$password = $this->superglobalManager->findPostVariable('password');

			// if connexion is successful
			if ($this->model->validateLogin($username, $password)) {
				$this->superglobalManager->setSessionVariable('admin', 'logged');
				header('location: index.php?controller=admin&action=menu');
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

	public function menu(): void {
		// if admin is not already logged in, we redirect to login menu
		if (!$this->superglobalManager->hasSessionVariable('admin')) {
			header('location: index.php?controller=admin&action=login');
		}
		$this->view->render('Admin Menu', 'adminMenuView');
	}
}