<?php

namespace App\Service;

use App\Models\Cars as CarModel;
use Core\Storage\Bases\Mysql;

class Cars
{
    protected $newCar;
    protected $db;
    protected $validator;

    public function __construct()
    {
        $this->newCar = new CarModel();
        $this->db = new Mysql();

    }

    public function getAll()
    {
        $sql = 'SELECT cars.id, brand_id, model_id, credit, number, status_id, brand_name, model_name, status_id, statuses.name AS status FROM `cars`
                LEFT JOIN car_brands ON brand_id = car_brands.id
                LEFT JOIN models ON model_id = models.id
                LEFT JOIN statuses ON status_id = statuses.id';
        $db = $this->db;

        return $db->query($sql, []);


    }

    public function create($post)
    {


        $newCar = $this->newCar;

        $newCar->number = $post['numb'];
        $newCar->credit = (float)$post['tax'];
        $newCar->status_id = (int)$post['status'];
        $newCar->brand_id = (int)$post['brand'];
        $newCar->model_id = (int)$post['carModel'];

        //$newCar->save();

        if (true) {

            return ['info' => ['Добавлен новый пользователь']];
        }

        return ['errors' => ['Save err...']];

    }

    public function update($post)
    {

        $newCar = $this->newCar;

        $oldCar = $this->newCar::findById((int)$post['carId']);



        $newCar->id = (int)$post['carId'];
        $newCar->number = $post['numb'];
        $newCar->credit = (float)$post['tax'];

        $newCar->status_id = (int)$post['status'] ;


        $newCar->brand_id = (int)$post['brand'];
        $newCar->model_id = (int)$post['carModel'];
        var_dump($oldCar);

        //$newCar->save() && (int)$post['status'] !== (int)$oldCar['status_id'];

        if (true) {

            //TODO add Msg "Change status"
            /**
             * create new fasade addMsg
             *
             * transfer to addMsg what has changed
             *
             * old status => new status
             *
             * car id
             *
             */

            return ['info' => ['Авто сохранено']];
        }

        return ['errors' => ['Save err...']];
    }

    /**
     * @param $post
     *
     * Ajax request get (json) car models by id car brands
     *
     * @return string
     */
    public function getModels($post)
    {
        $db = new Mysql();

        $sql = 'SELECT * FROM `models` WHERE `brands_id`=:id';

        return json_encode($db->query($sql, [':id' => (int)$post['id']]) ?? ['success' => false]);

    }

}