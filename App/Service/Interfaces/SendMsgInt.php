<?php

namespace App\Service\Interfaces;

interface SendMsgInt
{
    public function setRecipient($recipient);

    public function setHeader($header);

    public function setMsg($msg);

    public function send();

}