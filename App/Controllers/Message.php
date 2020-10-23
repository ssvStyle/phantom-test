<?php

namespace App\Controllers;

use Core\BaseController;

class Message extends BaseController
{
    public function getNew()
    {

        exit((new \App\Service\Message())->getNew());

    }

    public function setIsReadTrue()
    {

        exit((new \App\Service\Message())->setIsRead($_POST['idMsg'] ?? 0));

    }

}