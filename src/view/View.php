<?php
declare(strict_types=1);

namespace App\View;

class View
{
	public function render(string $pageTitle, string $filename, ?array $data = null) : void {
		ob_start();
		require_once('../templates/' . $filename . '.html.php'); // $data is used within this included file
		$pageContent = ob_get_clean();
		require_once('../templates/layout.html.php'); // $pageTitle and $pageContent are used inside the template
	}
}