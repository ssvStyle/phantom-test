<?php

namespace App\Controllers;

use App\Models\Group;
use App\Models\User;
use Core\BaseController;

class Administration extends BaseController
{
    public function users()
    {

        return $this->view->display('users.html.twig', [
            'users' => User::findAll(),
            'groups' => Group::findAll(),
        ]);
    }

}