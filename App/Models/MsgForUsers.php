<?php

namespace App\Models;

use Core\Model;

class MsgForUsers extends Model
{
    const TABLE = 'msg_for_users';

    public $user_id, $msg_status, $message_id, $is_read, $is_send_email, $time_to_timeout_to_send;

}