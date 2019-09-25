<?php
declare(strict_types=1);

class View
{
	public function __construct(string $path) {
		$this->_path = $path;
	}

	public function render(array $data) {
		require($this->_path);
		require('templates/template.html.php');
	}
}