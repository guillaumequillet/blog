<?php
declare(strict_types=1);

class Model 
{
	private $pdo;
	private $host     = 'localhost';
	private $database = 'projet4';
	private $username = 'root';
	private $password = '';

	public function getPDO(): PDO {
		if (!isset($this->pdo)) {
			$this->pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8', $this->username, $this->password);
		}
		var_dump("connexion db");
		return $this->pdo;
	}
}