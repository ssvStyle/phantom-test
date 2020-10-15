<?php

namespace Core;

use App\Service\Access;
use Core\Interfaces\RouterInterface;
use Core\LogSave\ToTxt;

/**
 * Class FrontController
 *
 * @package Core
 */
class FrontController
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $loger = new Loger();

        if ($this->router->response()){

            $params = $this->router->getRouteMapParams();

            $controllerName = 'App\Controllers\\' . ucfirst($params['controller']);
            $methodName = $params['method'];

            $access = new Access();

            $accessStatus = $params['access'] ?? 'admin';

            if ($access->permission($accessStatus)) {

                $controller = new $controllerName;

                $controller->setData($this->router->getParams());

                header('Access-Control-Allow-Origin: *');
                header('Content-type: text/html; charset=utf-8');

                echo $controller->$methodName();

            } else {

                $loger->log('alert', 'Access Denied' , [
                    'Access' =>  $accessStatus,
                    'Ctrl' => $controllerName,
                    'Method' => $methodName,
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'User agent' => $_SERVER['HTTP_USER_AGENT']
                ]);

                header("HTTP/1.0 401 Unauthorized");
                http_response_code(401);
                exit('Access Denied. You don’t have permission to access for this page');

            }



        } else {

            require_once __DIR__ . '../../templates/404.html';

            header("HTTP/1.0 404 Not Found");
            http_response_code(404);

        }

    }

}