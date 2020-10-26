<?php

namespace App\Service;

use App\Service\Interfaces\SendMsgInt;

class Mailing
{
    protected $email, $message;

    public function __construct(SendMsgInt $email)
    {
        $this->email = $email;
        $this->message = new Message();

    }
    
    
    public function email()
    {

        foreach ($this->message->getAllNoReadMsg() as $recipient) {

            $res = $this->email
                    ->setRecipient($recipient["email"])
                    ->setHeader($recipient["header"])
                    ->setMsg($recipient["message"])
                    ->send();

            if ($res) {

                $this->message->setIsSendEmail($recipient['id']);

            }

        }

    }

}