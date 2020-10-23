<?php

namespace App\Service;

use App\Models\MsgForUsers;
use Core\Storage\Bases\Mysql;

class Message
{
    protected $oldStatus, $newStatus, $avtoNum, $addMsg, $toSubscribers, $authUserId, $db;

    public function __construct()
    {
        $this->db = new Mysql();
        $this->addMsg = new AddMsg();
        $this->toSubscribers = new SendToSubscribers(new Mysql());
        $this->authUserId = (new Authorization($this->db))->getUid();

    }

    /**
     * @param mixed $oldStatus
     */
    public function setOldStatus(int $oldStatus)
    {
        $this->oldStatus = $oldStatus;
    }

    /**
     * @param mixed $newStatus
     */
    public function setNewStatus(int $newStatus)
    {
        $this->newStatus = $newStatus;
    }

    /**
     * @param mixed $avtoNum
     */
    public function setAvtoNum(string $avtoNum)
    {
        $this->avtoNum = $avtoNum;
    }


    public function add()
    {
        $msg = $this->addMsg->changeStatus($this->oldStatus, $this->newStatus, $this->avtoNum)->save();

        $this->toSubscribers->add($msg);
    }

    public function getNew()
    {

        $newMsgsQuery = 'SELECT msg_for_users.id, header, message, messages.login_who_edited as login, messages.created_at as date FROM `msg_for_users`
                        LEFT JOIN messages ON msg_for_users.message_id = messages.id
                        WHERE msg_status = \'new\' AND user_id = :uId
                        ORDER BY messages.created_at DESC';

        $msg = $this->db->query($newMsgsQuery, [':uId' => $this->authUserId]);

        $countAllNotRead = 'SELECT COUNT(*) FROM msg_for_users
                            WHERE is_read = 0 AND user_id = :uId';


        $newMsgs = [
            'countAllNotRead' => $this->db->query($countAllNotRead, [':uId' => $this->authUserId])[0]['COUNT(*)'] ?? 0,
            'newMsgs' => $msg
        ];



        foreach ($msg as $value) {

            $sqlUp = 'UPDATE `msg_for_users` SET `msg_status` = :newStatus WHERE `id` = :mId';

            $this->db->execute($sqlUp, [':newStatus' => 'send', ':mId' => $value['id']]);
        }

        return json_encode($newMsgs);
    }

    public function setIsRead(int $id)
    {

        $sqlUp = 'UPDATE `msg_for_users` SET `is_read` = :is_read WHERE `id` = :mId AND `user_id` = :userId';

        return $this->db->execute($sqlUp, [':is_read' => 1, ':mId' => $id, ':userId' => $this->authUserId]);


    }



}