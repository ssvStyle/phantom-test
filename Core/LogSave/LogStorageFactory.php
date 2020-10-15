<?php

namespace Core\LogSave;

use Core\Storage\Bases\TxtDb;

class LogStorageFactory
{

    public static function getStorage($type)
    {

        switch ($type) {
            case 'txt':
                return new ToTxt();
                break;
            case  'db':
                return new TxtDb();
                break;
        }

    }

}