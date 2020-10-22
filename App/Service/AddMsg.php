<?php

namespace App\Service;

use App\Models\Msg;
use App\Models\Statuses;

class addMsg
{
    protected $msg;
    protected $header;
    protected $status_id;
    protected $msgModel;
    protected $statuses;

    public function __construct()
    {
        $this->statuses = new Statuses();
        $this->msgModel = new Msg();


    }

    public function changeStatus($oldStatus, $newStatus, $avtoNum)
    {
        $this->header = 'Изменение статуса';
        $this->status_id = (int)$newStatus;

        $status = $this->statuses;

        $this->msg = 'Изменился статус у авто с номером ' . $avtoNum . ' c "' . $status::findById($oldStatus)['name'] . '" на "' . $status::findById($newStatus)['name'] . '".';

        return $this;

    }

    public function save()
    {

        $this->msgModel->header = $this->header;
        $this->msgModel->message = $this->msg;
        $this->msgModel->login_who_edited = $_SESSION['name'];
        $this->msgModel->created_at = time();
        $this->msgModel->status_from_settings = $this->status_id;

        if ($this->msgModel->save()) {

            return $this->msgModel;

        }


    }

}