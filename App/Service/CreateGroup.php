<?php

namespace App\Service;

use App\Models\Group;

class CreateGroup
{
    public function group($post)
    {

        $groupModel = new Group();

        $groupModel->group_name = $post['groupName'];

        if ($groupModel->save()) {
            return 'Добавлена новая группа';
        }

        return 'Error ...';

    }

}