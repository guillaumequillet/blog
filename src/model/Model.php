<?php
declare(strict_types=1);

namespace App\Model;

use App\Tool\Database;
use \PDO;

class Model {
	protected $database;

	public function __construct(Database $database) {
		$this->database = $database;
	}

	public function getPDO() : PDO {
		return $this->database->getPDO();
	}
}
