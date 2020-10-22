<?php

namespace App\Models;

use Core\Model;

class Msg extends Model
{
    const TABLE = 'messages';
    public $login_who_edited, $header, $message, $status_from_settings, $created_at;



}