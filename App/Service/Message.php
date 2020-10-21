<?php

namespace App\Service;


class Message
{
    protected $oldStatus, $newStatus, $avtoNum, $addMsg;

    public function __construct()
    {
        $this->addMsg = new AddMsg();
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
        $this->addMsg->changeStatus($this->oldStatus, $this->newStatus, $this->avtoNum)->save();

    }

    public function getNew()
    {
        return json_encode([
            'countMsg' => 4,
            'newMsgs' => [
                [
                    'msgId' => 1,
                    'header' => 'Changes in car status1',
                    'msg' => 'Изменился статус у авто с номером HB0811LK c "На выдачу" на "Угон".',
                    'date' => date('Y-m-d H:i:s', 1603280866),
                    'login' => 'ssv'
                ],
                [
                    'msgId' => 2,
                    'header' => 'Changes in car status2',
                    'msg' => 'Изменился статус у авто с номером HB0811LK c "На выдачу" на "Угон".',
                    'date' => date('Y-m-d H:i:s', 1603280866),
                    'login' => 'ssv'
                ],
                [
                    'msgId' => 3,
                    'header' => 'Changes in car status3',
                    'msg' => 'Изменился статус у авто с номером HB0811LK c "На выдачу" на "Угон".',
                    'date' => date('Y-m-d H:i:s', 1603280866),
                    'login' => 'ssv'
                ],
                [
                    'msgId' => 4,
                    'header' => 'Changes in car status4',
                    'msg' => 'Изменился статус у авто с номером HB0811LK c "На выдачу" на "Угон".',
                    'date' => date('Y-m-d H:i:s', 1603280866),
                    'login' => 'ssv'
                ]
            ]
        ]);
    }




}