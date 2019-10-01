<?php
declare(strict_types=1);

class Model 
{
	private $_pdo;
	private $_host     = 'localhost';
	private $_database = 'projet4';
	private $_username = 'root';
	private $_password = '';

	public function getPDO(): PDO {
		if (!isset($this->_pdo)) {
			$this->_pdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=utf8', $this->_username, $this->_password);
		}
		var_dump("connexion db");
		return $this->_pdo;
	}
}