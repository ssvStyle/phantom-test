<?php

namespace Core\Storage;

use Core\Interfaces\Db\DataBaseInterface;

abstract class Storage
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->get();
    }

    public function query($sql, $data = [])
    {
        return $this->db->query($sql, $data);
    }

    public function queryRetObj($sql, $data = [], $class)
    {
        return $this->db->queryRetObj($sql, $data, $class);
    }

    public function execute($sql, $data = [])
    {
        return $this->db->execute($sql, $data);
    }

    public function getLastInsertId()
    {
        return $this->db->getLastInsertId();
    }


    /**
     * @return DataBaseInterface
     */
    abstract public function get():DataBaseInterface;
}