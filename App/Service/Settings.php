<?php

namespace App\Service;

use Core\Storage\Bases\Mysql;

class Settings
{
    protected $id, $db;

    public function __construct(int $id)
    {

        $this->id = $id;
        $this->db = new Mysql();

    }

    public function getUser()
    {
        $sql = 'SELECT * FROM `user_settings` WHERE user_id = :id';

        return $this->db->query($sql, [':id' => $this->id]);

    }

    public function getGroup()
    {
        $sql = 'SELECT * FROM `groop_settings` WHERE group_id = :id';

        return $this->db->query($sql, [':id' => $this->id]);

    }

    public function setGroup(array $settings)
    {

        $sql = 'DELETE FROM groop_settings WHERE group_id = :uid';

        $this->db->execute($sql, [':uid' => $this->id]);

        foreach($settings as $value) {

            $sql = 'INSERT INTO `groop_settings`(`group_id`, `setting_id`) VALUES (:group_id, :setting_id)';

            $this->db->execute($sql, [':group_id' => $this->id, ':setting_id' => (int)$value]);

        }



    }

    public function setUser(array $settings)
    {
        $sql = 'DELETE FROM user_settings WHERE user_id = :uid';

        $this->db->execute($sql, [':uid' => $this->id]);

        foreach($settings as $value) {

            $sql = 'INSERT INTO `user_settings`(`user_id`, `setting_id`) VALUES (:user_id, :setting_id)';

            $this->db->execute($sql, [':user_id' => $this->id, ':setting_id' => (int)$value]);

        }

        exit();


    }


}