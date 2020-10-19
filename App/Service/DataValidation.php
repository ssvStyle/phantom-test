<?php

namespace App\Service;

use App\Service\Interfaces\ValidationInterface;

/**
 * Class DataValidation
 *
 * Validation incoming data
 *
 *
 * @package App\Models
 */

class DataValidation implements ValidationInterface
{
    /**
     * var data (all data container)
     *
     * @var data
     */
    protected $data;

    /**
     * DataValidation constructor.
     *
     *assigns to a variable data from global var $_POST
     *
     * @param $post
     */
    public function __construct(array $post)
    {

        $this->data = $post;

    }

    /**
     * trim space around text Check empty
     *
     * @return bool
     */

    public function fieldName():bool
    {
        $name = $this->data['name'] ?? '';
        $this->data['name'] = trim($name);

        return !empty($this->data['name']) ? true : false;
    }

    /**
     * filter end valid email
     *
     * @return bool
     */
    public function fieldEmail():bool
    {
        $email = $this->data['email'] ?? '';
        $this->data['email'] = filter_var($email, FILTER_VALIDATE_EMAIL);
        return $this->data['email'] ? true : false;
    }

    /**
     * check a string that must be at least 20 characters
     *
     * @return bool
     */
    public function fieldTask():bool
    {
        $task = $this->data['job'] ?? '';

        $this->data['job'] = trim($task);

        $cond = (mb_strlen($this->data['job']) > 20);

        return $cond ? true : false;
    }

    /**
     * reduce to the number
     *
     * @return bool
     */
    public function fieldStatusId()
    {
        $id = $this->data['status'] ?? '';

        $this->data['status'] = (int)$id;

        $cond = $this->data['status'] !== 0 && $this->data['status'] > 0;

        return $cond;
    }

    /**
     * return validation data
     *
     * @return array
     */
    public function getValidData():array
    {
        return $this->data;
    }
}