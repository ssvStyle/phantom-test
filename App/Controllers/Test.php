<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Storage\Bases\Mysql;

class Test extends BaseController
{

    public function run()
    {
        $db = new Mysql();

        $sql = 'SELECT * from statuses';


        $res = $db->query($sql, []);


        //var_dump($res);die;



        $sql = 'SELECT users.id as user_id, GROUP_CONCAT(DISTINCT user_settings.setting_id) as user_settings_id, GROUP_CONCAT(DISTINCT groop_settings.setting_id) group_settings_id FROM users
                LEFT JOIN user_settings ON user_settings.user_id = users.id
                LEFT JOIN groop_settings ON groop_settings.group_id = users.group_id
                LEFT JOIN statuses ON statuses.id = user_settings.setting_id
                WHERE (user_settings.setting_id = :id)
                or    (user_settings.setting_id IS NULL AND groop_settings.setting_id = :id)
                GROUP BY users.id';


        //$res2 = $db->query($sql, [':id' => '']);

        $res2 = [];

        foreach ($res as $value) {

            $res2[$value['name']. '{' . $value['id'] . '}'] = $db->query($sql, [':id' => $value['id']]);

        }

        var_dump($res2);

        die;

    }

}