<?php

namespace App\Controllers;

use Core\BaseController;

class Message extends BaseController
{
    public function getNew()
    {

        exit((new \App\Service\Message())->getNew());

    }

}