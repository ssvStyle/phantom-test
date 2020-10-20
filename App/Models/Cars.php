<?php

namespace App\Models;

use Core\Model;

class Cars extends Model
{

    const TABLE = 'cars';
    public $brand_id, $model_id, $number, $credit, $status_id;

}