<?php

namespace App\Controllers;


use Core\BaseController;

class Administration extends BaseController
{
    public function users()
    {

        return $this->view->render('users.html.twig');
    }

}