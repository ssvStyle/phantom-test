<?php

namespace App\Service\Interfaces;


interface UserValidInterf
{
    public function check(string $login);

    public function login(string $login);

    public function psw(string $psw);

    public function email(string $email);

    public function getErrors() : array;

}