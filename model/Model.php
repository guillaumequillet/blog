<?php
class Model 
{
	private $_pdo;
	private $_host     = 'localhost';
	private $_database = 'projet4';
	private $_username = 'root';
	private $_password = '';

	public function __construct() {

	}	

	public function getPDO() {
		if (!isset($this->pdo)) {
			$this->pdo = new PDO('dblib:host=' . $this->host .';dbname=' . $this->dabatase . ';charset=UTF-8', $this->_username, $this->_password);
		}
		return $this->pdo;
	}
}