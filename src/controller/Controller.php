<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Tool\Database;

class Controller 
{
    protected $database;
    protected $model;
    protected $view;
    protected $data;

    public function __construct() {
        $this->database = new Database();
        $this->view = new View();
    }
}
