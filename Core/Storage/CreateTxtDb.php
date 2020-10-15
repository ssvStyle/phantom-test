<?php

namespace Core\Storage;

use Core\Interfaces\Db\DataBaseInterface;
use Core\Storage\Bases\TxtDb;


class CreateTxtDb extends Storage
{
    public function get():DataBaseInterface
    {
        return new TxtDb();
    }
}