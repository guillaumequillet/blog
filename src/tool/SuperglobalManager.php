<?php
declare(strict_types=1);

namespace App\Tool;

class SuperglobalManager {
	public function hasPostVariable(string $key) : bool {
		return isset($_POST[$key]);
	}

	public function findPostVariable(string $key) : ?string {
		return isset($_POST[$key]) ? htmlentities($_POST[$key]) : null;
	}

	public function hasSessionVariable(string $key) : bool {
		return isset($_SESSION[$key]);
	}

	public function findSessionVariable(string $key) : ?string {
		return isset($_SESSION[$key]) ? htmlentities($_SESSION[$key]) : null;
	}

	public function setSessionVariable(string $key, string $value) : void {
		$_SESSION[$key] = htmlentities($value);
	}

	public function deleteSessionVariable(string $key) {
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
	}
}