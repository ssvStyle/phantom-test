<?php

namespace App\Service;

use App\Models\User as UserModel;
use App\Service\Interfaces\UserValidInterf;

class User
{
    protected $userData;
    protected $validator;

    public function __construct($data, UserValidInterf $validator)
    {
        $this->user = new UserModel();
        $this->userData = $data;
        $this->validator = $validator;
    }

    public function create()
    {
        $this->validator->check($this->userData['login']);
        $this->validator->login($this->userData['login']);
        $this->validator->psw($this->userData['psw']);
        $this->validator->email($this->userData['email']);

        if (!empty($this->validator->getErrors())) {

            return $this->validator->getErrors();

        }

        $userModel = $this->user;

        $userModel->login = $this->userData['login'];
        $userModel->psw = password_hash($this->userData['psw'], PASSWORD_DEFAULT);
        $userModel->email = $this->userData['email'];
        $userModel->group_id = (int)$this->userData['group'];
        $userModel->session_token = '';
        $userModel->created_at = time();
        //$userModel->updated_at = '';

        if ($userModel->save()) {

            return ['info' => ['Добавлен новый пользователь']];
        }

        return ['errors' => ['Save err...']];
;

    }

    public function update()
    {
        $this->validator->login($this->userData['login']);
        $this->validator->email($this->userData['email']);

        if (!empty($this->validator->getErrors())) {

            return $this->validator->getErrors();

        }

        $oldUsr = $this->user::findById((int)$this->userData['id']);

        $userModel = $this->user;

        $userModel->id = $this->userData['id'];
        $userModel->login = $this->userData['login'];
        if ($this->userData['psw'] != '') {
            $userModel->psw = password_hash($this->userData['psw'], PASSWORD_DEFAULT);
        } else {
            $userModel->psw = $oldUsr['psw'];
        }
        $userModel->email = $this->userData['email'];
        $userModel->group_id = (int)$this->userData['group'];
        $userModel->session_token = $oldUsr['session_token'];
        $userModel->created_at = $oldUsr['created_at'];
        //$userModel->updated_at = time();

        if ($userModel->save()) {

            return ['info' => ['Пользователь обновлен']];
        }

        return ['errors' => ['Save err...']];

    }

}