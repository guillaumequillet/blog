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
}