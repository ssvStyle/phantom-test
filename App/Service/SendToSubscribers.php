<?php

namespace App\Service;

use App\Models\Msg;
use App\Models\MsgForUsers;
use Core\Interfaces\Db\DataBaseInterface;

class SendToSubscribers
{
    protected $db, $auth;

    public function __construct(DataBaseInterface $db)
    {
        $this->db = $db;
        $this->auth = new Authorization($db);

    }

    public function add(Msg $msgModel)
    {
        $sql = 'SELECT users.id as user_id, GROUP_CONCAT(DISTINCT user_settings.setting_id) as user_settings_id, GROUP_CONCAT(DISTINCT groop_settings.setting_id) group_settings_id FROM users
                LEFT JOIN user_settings ON user_settings.user_id = users.id
                LEFT JOIN groop_settings ON groop_settings.group_id = users.group_id
                LEFT JOIN statuses ON statuses.id = user_settings.setting_id
                WHERE  ((user_settings.setting_id = :id)
                or    ((user_settings.setting_id IS NULL OR  user_settings.setting_id != :id) AND groop_settings.setting_id = :id)) AND users.id != :authUsr
                GROUP BY users.id';

        $userIds = $this->db->query($sql, [':id' => $msgModel->status_from_settings, ':authUsr' => $this->auth->getUid()]);

        foreach ($userIds as $value) {

            $newMsgModel = new MsgForUsers();

            $newMsgModel->message_id = (int)$msgModel->id;
            $newMsgModel->is_read = 0;
            $newMsgModel->msg_status = 'new';
            $newMsgModel->time_to_timeout_to_send = time() + 600;
            $newMsgModel->is_send_email = 0;
            $newMsgModel->user_id = $value['user_id'];

            $newMsgModel->save();

        }

    }

}