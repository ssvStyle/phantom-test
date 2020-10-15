<?php

namespace Core\Interfaces;


interface AccessInt
{
    public function permission(string $permissionList) : bool ;
}