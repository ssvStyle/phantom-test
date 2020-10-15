<?php
namespace Core\Storage;

require_once __DIR__ . '/Bases/Mysql.php';

use Core\Interfaces\Db\DataBaseInterface;
use Core\Storage\Bases\Mysql;

class CreateMysql extends Storage
{
    public function get():DataBaseInterface
    {
        return new Mysql();
    }
}