<?php

namespace App\Service;

use Core\Interfaces\AccessInt;

class Access implements AccessInt
{

    public function permission(string $permissionList): bool
    {
        if ($permissionList === 'all') {
            return true;
        }

        return false;
    }
}