<?php

namespace App\Controllers;

use App\Service\Cars;
use Core\BaseController;

class CarPark extends BaseController
{
    public function allCars()
    {

        return $this->view->display('cars.html.twig', [
            'carBrands' => \App\Models\CarBrands::findAll(),
            'statuses' => \App\Models\Status::findAll(),
            'allCars' => (new Cars())->getAll(),
        ]);

    }

    public function create()
    {
        $this->setGlobalNotifications([
            'msg' => (new Cars())->create($_POST),
        ]);

        $this->redirectTo('/directory/car-park');
    }

    public function update()
    {
        $this->setGlobalNotifications([
            'msg' => (new Cars())->update($_POST),
        ]);

        $this->redirectTo('/directory/car-park');
    }


    /**
     * //Ajax request get (json) car models by id car brands
     *
     * @return array (json)
     */
    public function getCarModels()
    {
        exit((new Cars())->getModels($_POST));
    }

}