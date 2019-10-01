<?php
declare(strict_types=1);

class Controller 
{
	protected $model;
	protected $view;
	protected $data;

	public function __construct() {
		$this->view = new View();
	}
}