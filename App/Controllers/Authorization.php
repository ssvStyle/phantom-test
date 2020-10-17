<?php

namespace App\Controllers;

use App\Service\AuthService;
use Core\BaseController;

class Authorization extends BaseController
{

    public function login()
    {
        return $this->view->display('auth/login.html.twig');
    }

    public function logout()
    {
        $authService = new AuthService();
        $authService->unsetAuth();
        $this->redirectTo('/login');
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