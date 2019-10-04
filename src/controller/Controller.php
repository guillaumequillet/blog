<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Tool\Database;

require_once('src/tool/SuperglobalManager.php');
require_once('src/tool/Database.php');
require_once('src/view/View.php');

class Controller 
{
	protected $database;
	protected $model;
	protected $view;
	protected $data;

	public function __construct() {
		$this->database = new Database();
		$this->view = new View();
	}
}