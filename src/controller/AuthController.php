<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\UserModel;
use App\View\View;

class AuthController extends Controller 
{
    // Connexion
    public function login(?int $param = null): void 
    {
        // if admin is already logged in, we redirect to admin menu
        if ($this->superglobalManager->hasSessionVariable('admin')) {
            header('location: index.php?controller=admin&action=episodes');
            exit();
        } 

        $this->data['param'] = $param;
        $this->data['token'] = $this->token->generateString();
        $this->view->render('Admin Login', 'authLoginView', $this->data);
    }   

    public function validateLogin(): void 
    {
        if (!$this->token->check()) {
            header('location: index.php?controller=auth&action=login&param=0');
            exit();
        }

        // if admin is already logged in, we redirect to admin menu
        if ($this->superglobalManager->hasSessionVariable('admin')) {
            header('location: index.php?controller=admin&action=episodes');
            exit();
        }

        $this->model = new UserModel($this->database);
        $username = $this->superglobalManager->findPostVariable('username');
        $password = $this->superglobalManager->findPostVariable('password');

        // if connexion is successful
        if ($this->model->validateLogin($username, $password)) {
            $this->superglobalManager->setSessionVariable('admin', 'logged');
            header('location: index.php?controller=admin&action=episodes');
            exit();
        }   

        // if connexion failed
        header('location: index.php?controller=auth&action=login&param=0');
    }

    public function logout(): void 
    {
        $this->superglobalManager->deleteSessionVariable('admin');
        header('location: index.php?controller=auth&action=login&param=1');
    }
}
