<?php
class Model 
{
	private $_pdo;
	private $_host     = 'localhost';
	private $_database = 'projet4';
	private $_username = 'root';
	private $_password = '';

	public function getPDO() {
		if (!isset($this->_pdo)) {
			$this->_pdo = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=utf8', $this->_username, $this->_password);
		}
		return $this->_pdo;
	}
}