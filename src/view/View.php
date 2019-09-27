<?php
declare(strict_types=1);

class View
{
	public function __construct(string $path) {
		$this->_path = $path;
	}

	public function render(string $pageTitle, ?array $data) {
		ob_start();
		require($this->_path);
		$pageContent = ob_get_clean();
		require('templates/template.html.php');
	}
}