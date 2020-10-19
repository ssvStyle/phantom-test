<?php

namespace Core;

use App\Models\User;
use App\View;
use Core\Interfaces\BaseController as BaseControllerInterfase;

abstract class BaseController implements BaseControllerInterfase
{
    /*
     *$data for transfer to all classes of controllers
     */

    public $data;

    /*
     *$view obj for transfer to all classes of controllers
     */

    public $view;

    public function __construct()
    {

        $loader = new \Twig\Loader\FilesystemLoader('../templates');

        $this->view = new \Twig\Environment($loader, [
            'debug' => true,
            'cache' => '../cache',
            'auto_reload' => true
        ]);
        $this->view->addExtension(new \Twig\Extension\DebugExtension());

        $this->view->addGlobal('notifications', $_SESSION['notifications'] ?? '');
        $_SESSION['notifications'] = '';
        $this->view->addGlobal('name', $_SESSION['name'] ?? 'User');
        $this->view->addGlobal('host', require __DIR__ . '/../config/host.php');
    }

    /**
     * @param array $data
     */
    public function setData(array $data = [])
    {
        $this->data = $data;
    }

    public function access($bool = true)
    {
        if (!$bool) {
            http_response_code(401);
            exit('401 Unauthorized');
        }

        return $this;
    }

    public function redirectTo($link = '/')
    {

        header('Location:' . $link);

    }

    public function setGlobalNotifications(array $notifi = [])
    {

        $_SESSION['notifications'] = $notifi;

    }

}