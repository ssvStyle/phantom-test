<?php

namespace App\Controllers;

use App\Service\AuthService;
use Core\BaseController;

class Authorization extends BaseController
{

    public function login()
    {
        echo $this->view
            ->display('auth/login.html.twig');
    }

    public function logout()
    {
        echo 'Authorization Controller and method logout';
    }

    public function signIn()
    {
        $authService = new AuthService();

        if (!$authService->set($_POST)) {
            header('Location: /login');
        }

        header('Location: /');
    }

}