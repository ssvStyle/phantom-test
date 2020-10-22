<?php

namespace App\Service;

use Core\Storage\Bases\Mysql;

class Message
{
    protected $oldStatus, $newStatus, $avtoNum, $addMsg, $toSubscribers, $auth, $db;

    public function __construct()
    {
        $this->db = new Mysql();
        $this->addMsg = new AddMsg();
        $this->toSubscribers = new SendToSubscribers(new Mysql());
        $this->auth = new Authorization($this->db);

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
        $idAuthUsr = (int)$this->auth->getUid()['id'];

        $sql = 'SELECT msg_for_users.id, header, message, messages.login_who_edited as login, messages.created_at as date FROM `msg_for_users`
                LEFT JOIN messages ON msg_for_users.message_id = messages.id
                WHERE msg_status = \'new\' AND user_id = :uId
                ORDER BY messages.created_at DESC';

        $msg = $this->db->query($sql, ['uId' => $idAuthUsr]);

        $newMsgs = [
            'countMsg' => count($msg),
            'newMsgs' => $msg
        ];

        return json_encode($newMsgs);
    }




}