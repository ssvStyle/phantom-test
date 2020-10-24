<?php

namespace App\Controllers;

use App\Models\Statuses;
use App\Service\Settings;
use Core\BaseController;
use App\Models\Group;
use App\Models\User;


class AdministrationSettings extends BaseController
{
    
    public function getAllSettings()
    {
        return $this->view->display('settings.html.twig', [
            'users' => User::findAll(),
            'groups' => Group::findAll(),
            'settings' => Statuses::findAll(),
        ]);
    }
    
    public function setGroup()
    {
        return (new Settings((int)$_POST['uid'] ?? 0))->setGroup(json_decode($_POST['settings'] ?? []));

    }

    public function setUser()
    {

        return (new Settings((int)$_POST['uid']))->setUser(json_decode($_POST['settings']));

    }

    public function getSettById()
    {

        switch ($this->data['settings']){
            case 'group':
                return json_encode((new Settings((int)$_POST['id']))->getGroup());
                break;
            case 'user':
                return json_encode((new Settings((int)$_POST['id']))->getUser());
                break;
            default:
                return [];
        }

    }



}