<?php

namespace App\Service;

use App\Models\Group as ModelGroup;

class Group
{
    public function create($post)
    {

        $groupModel = new ModelGroup();

        if (mb_strlen(trim($post['groupName'])) < 3) {
            return ['errors' => ['Короткое имя!!!']];
        }

        $all = $groupModel::findAll();

        foreach ($all as $obj) {
            if ($obj->group_name === $post['groupName']) {

                return ['errors' => ['Група с таким именем уже есть']];

            }
        }

        $groupModel->group_name = $post['groupName'];

        if ($groupModel->save()) {
            return ['info' => ['Добавлена новая группа']];
        }

        return ['errors' => ['Save err...']];

    }

}