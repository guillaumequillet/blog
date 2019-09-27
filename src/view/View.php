<?php
declare(strict_types=1);

class View
{
	public function __construct(string $path) {
		$this->_path = $path;
	}

	public function render(string $pageTitle, ?array $data) {
		ob_start();
		require($this->_path); // $data is used within this included file
		$pageContent = ob_get_clean();
		require('templates/template.html.php'); // $pageTitle and $pageContent are used inside the template
	}
}