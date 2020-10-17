<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    public const TABLE = 'users';
    public $login, $psw, $email, $created_at, $group_id, $session_token;

}