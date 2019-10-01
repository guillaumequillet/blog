<?php
declare(strict_types=1);

class View
{
	public function render(string $pageTitle, string $path, ?array $data = null) : void {
		ob_start();
		require('src/view/' . $path); // $data is used within this included file
		$pageContent = ob_get_clean();
		require('templates/template.html.php'); // $pageTitle and $pageContent are used inside the template
	}
}