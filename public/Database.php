<?php
declare(strict_types=1);

class Database 
{
	protected $pdo;
	protected $host     = 'localhost';
	protected $database = 'projet4';
	protected $username = 'root';
	protected $password = '';

	public function getPDO(): PDO {
		if (!isset($this->pdo)) {
			$this->pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8', $this->username, $this->password);
		}
		return $this->pdo;
	}
}