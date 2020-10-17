<?php

namespace App\Controllers;

use App\Service\CreateGroup;
use App\Service\CreateUser;
use Core\BaseController;

class Create extends BaseController
{
    public function user()
    {
        $create = new CreateUser();

        $this->setGlobalNotifications([
            'info' => $create->newUser($_POST),
        ]);

        $this->redirectTo('/administration/users');

    }

    public function group()
    {
        $create = new CreateGroup();

        $this->setGlobalNotifications([
            'info' => $create->group($_POST),
        ]);

        $this->redirectTo('/administration/users');
    }

}