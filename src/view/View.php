<?php
declare(strict_types=1);

namespace App\View;

class View
{
    private $template;

    public function __construct(?string $template = '../templates/layout.html.php') 
    {
        $this->template = $template;
    }

    public function setTemplate(string $template): void 
    {
        $this->template = $template;
    }

    public function render(string $pageTitle, string $filename, ?array $data = null) : void 
    {
        ob_start();
        require_once('../templates/' . $filename . '.html.php'); // $data is used within this included file
        $pageContent = ob_get_clean();
        require_once($this->template); // $pageTitle and $pageContent are used inside the template
    }
}
