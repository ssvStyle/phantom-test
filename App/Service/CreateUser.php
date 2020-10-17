<?php

namespace App\Service;

use App\Models\User;

class CreateUser
{
    public function newUser($post)
    {

        $userModel = new User();

        $userModel->login = $post['login'];
        $userModel->psw = password_hash($post['psw'], PASSWORD_DEFAULT);
        $userModel->email = $post['email'];
        $userModel->created_at = time();
        $userModel->group_id = (int)$post['group'];
        $userModel->session_token = '';


        if ($userModel->save()) {
            return 'Добавлен новый пользователь';
        }

        return 'Error ...';
    }

    public function editUser($post)
    {

        $userModel = new User();

        $userModel->id = (int)$post['id'];
        $userModel->login = $post['login'];
        if ($post['psw'] != '') {
            $userModel->psw = password_hash($post['psw'], PASSWORD_DEFAULT);
        } else {
            $oldUsr = $userModel::findById((int)$post['id']);
            $userModel->psw = $oldUsr['psw'];
        }
        $userModel->email = $post['email'];
        $userModel->created_at = time();
        $userModel->group_id = (int)$post['group'];
        $userModel->session_token = '';

        if ($userModel->save()) {
            return 'Пользователь обновлен';
        }

        return 'Error ...';

    }

}