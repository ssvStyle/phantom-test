<?php

namespace App\Service;

use App\Service\Interfaces\SendMsgInt;

class Email implements SendMsgInt
{

    protected $recipient;

    public function setRecipient($recipient)
    {
        // TODO: Implement setWho() method.

        return $this;
    }

    public function setHeader($header)
    {
        // TODO: Implement setHeader() method.
        return $this;

    }

    public function setMsg($msg)
    {
        // TODO: Implement setMsg() method.
        return $this;

    }

    public function send()
    {
        // TODO: Implement send() method.

        return true;
    }


}