<?php

namespace App\Service;

class AuthService
{
    public function set(array $post) : bool
    {
        if ($post['uname'] != 'admin' || $post['psw'] != 123) {
            return false;
        }

        return true;
    }

}