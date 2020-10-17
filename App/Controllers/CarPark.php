<?php

namespace App\Controllers;

use Core\BaseController;

class CarPark extends BaseController
{
    public function cars()
    {
        return $this->view->display('cars.html.twig');

    }

}