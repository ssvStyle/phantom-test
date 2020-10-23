<?php

namespace App\Controllers;

use Core\BaseController;

class Message extends BaseController
{
    public function showAll()
    {
        return $this->view->display('messages.html.twig', [
            'newMsg' => (new \App\Service\Message)->getAllFullMsg(),
            'readMsg' => (new \App\Service\Message)->getAllFullMsg(1),//is_read = 1
        ]);

    }

    public function getNew()
    {

        exit((new \App\Service\Message())->getNew());

    }

    public function setIsReadTrue()
    {

        exit((new \App\Service\Message())->setIsRead($_POST['idMsg'] ?? 0));

    }

    public function getOne()
    {

        exit((new \App\Service\Message())->getOne((int)$_POST['idMsg'] ?? 0));

    }

}