<?php

namespace App\Controllers;

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

        $this->redirectTo('/administration/users');
    }

    public function update()
    {
        $this->setGlobalNotifications([
            'msg' => (new User($_POST, new UserFieldValidation))->update(),
        ]);

        $this->redirectTo('/administration/users');
    }

}