<?php

namespace App\Service;

use Core\Storage\Bases\Mysql;

class AuthService
{
    public function set(array $post) : bool
    {

        $authorization = new Authorization(new Mysql());

        if ($authorization->loginExist($post['login'])) {

            if ($authorization->loginAndPassValidation($post['login'], $post['psw'])) {

                return $authorization->setAuth($post['remember'] ?? false);
            }

        }

        return true;
    }

    public function unsetAuth() : bool
    {

        $authorization = new Authorization(new Mysql());
        return $authorization->exitAuth();

    }

}