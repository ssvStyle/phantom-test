<?php

namespace App\Models;

use Core\Model;

class CarModels extends Model
{
    const TABLE = 'models';
    public $id, $model_name, $brands_id;

}