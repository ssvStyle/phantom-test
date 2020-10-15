<?php
session_start();
$start = microtime(true);

include __DIR__ . '/../vendor/autoload.php';

use Core\FrontController;
use Core\Router;

/**
 * SIMON-LIB
 */


$myApp = new FrontController(new Router( $_SERVER['REQUEST_URI'] ));

$myApp->run();

if (require __DIR__ . '/../config/scriptTime.php') {

    include __DIR__ . '/../templates/time.php';

}