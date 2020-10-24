<?php

namespace App\Controllers;

use App\Models\Group;
use App\Service\UserFieldValidation;
use Core\BaseController;
use App\Service\User;

class AdministrationUser extends BaseController
{
    public function create()
    {
        $this->setGlobalNotifications([
            'msg' => (new User($_POST, new UserFieldValidation))->create(),
        ]);

        $this->redirectTo('/administration/users/all');
    }

    public function update()
    {
        $this->setGlobalNotifications([
            'msg' => (new User($_POST, new UserFieldValidation))->update(),
        ]);

        $this->redirectTo('/administration/users/all');
    }

    public function getAllUsersAndGroup()
    {

        return $this->view->display('users.html.twig', [
            'users' => \App\Models\User::findAll(),
            'groups' => Group::findAll(),
        ]);
    }

}