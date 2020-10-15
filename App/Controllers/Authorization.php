<?php

namespace App\Controllers;

use Core\BaseController;

class Authorization extends BaseController
{

    public function login()
    {
        echo $this->view
            ->display('auth/login.html.twig');
    }

    public function register()
    {
        echo $this->view->display('auth/register.html.twig');
    }

    public function logout()
    {
        echo 'Authorization Controller and method logout';
    }

}