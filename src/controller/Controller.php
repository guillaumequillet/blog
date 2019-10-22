<?php
declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Tool\Database;
use App\Tool\SuperglobalManager;
use App\Tool\Token;

class Controller 
{
    protected $database;
    protected $model;
    protected $view;
    protected $data;

    public function __construct() 
    {
        $this->database = new Database();
        $this->view = new View();
        $this->superglobalManager = new SuperglobalManager();
        $this->token = new Token();
    }
}
