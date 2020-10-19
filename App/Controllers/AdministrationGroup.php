<?php

namespace App\Controllers;

use Core\BaseController;
use App\Service\Group;

class AdministrationGroup extends BaseController
{
    public function create()
    {
        $group = new Group();

        $this->setGlobalNotifications([
            'msg' => $group->create($_POST),
        ]);

        $this->redirectTo('/administration/users');
    }

}