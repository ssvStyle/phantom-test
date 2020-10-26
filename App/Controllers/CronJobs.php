<?php

namespace App\Controllers;

use App\Service\Email;
use App\Service\Mailing;
use Core\BaseController;

class CronJobs extends BaseController
{

    public function sendEmailToUsersWhoHaveNotReadMsg ()
    {
        (new Mailing(new Email()))->email();
        exit();
    }

}