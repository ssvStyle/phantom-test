<?php

namespace App\Service;

use Core\Interfaces\AccessInt;
use Core\Storage\Bases\Mysql;

class Access implements AccessInt
{

    public function permission(string $permissionList): bool
    {
        if ($permissionList === 'all') {
            return true;
        }

        $authorization = new Authorization(new Mysql());
        return $authorization->userVerify();

    }
}