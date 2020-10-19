<?php

namespace App\Service;

use App\Service\Interfaces\UserValidInterf;
use Core\Storage\Bases\Mysql;

class UserFieldValidation implements UserValidInterf
{
    protected $errors = [];
    protected $check;

    public function __construct()
    {

        $this->check = new Authorization(new Mysql);

    }

    public function check(string $login)
    {
        if ($this->check->loginExist($login)) {

            $this->errors['errors'][] = 'Логин занят';

        }
    }


    public function login(string $login)
    {
        if (mb_strlen(trim($login)) < 3) {
            $this->errors['errors'][] = 'Логин слишком короткий';
        }

    }

    public function psw(string $psw)
    {
        if (empty(trim($psw))) {
            $this->errors['errors'][] = 'Пароль не может быть пустым';
        } else if (mb_strlen(trim($psw)) < 3) {
            $this->errors['errors'][] = 'Пароль слишком короткий';
        }
    }

    public function email(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->errors['errors'][] = 'Некорректный email';
        }

    }

    /**
     * @return array
     */
    public function getErrors() : array
    {
        return $this->errors;
    }

}