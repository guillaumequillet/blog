<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;
use App\View\View;

class AdminController extends Controller 
{
	public function __construct() {
		parent::__construct();
		$this->data = [];
		$this->view->setTemplate('../templates/adminLayout.html.php');
	}

	public function user(): void {
		$this->view->render('Paramètres de connexion', 'adminUserView');
	}

	public function comments(): void {
		$this->view->render('Modération des commentaires', 'adminCommentsView');
	}

	public function episodes(): void {
		$this->view->render('Gestion des épisodes', 'adminEpisodesView');
	}
}
