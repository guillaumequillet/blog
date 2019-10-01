<?php
declare(strict_types=1);

require_once('public/SuperglobalManager.php');
require_once('public/Database.php');

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