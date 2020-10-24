<?php
/**
 * This is a routes file.
 *
 * The route and controller, method can be set in the format

 *
 * route
 *
 * 'web' => [
 *   'route' => '/article/show/{id}',
 *   'requestMethod' => 'POST'  ? 'GET' default
 *   'controller' => 'home',
 *   'method' => 'index',
 *   'access' => false   ? true default
 *   ],
 *
 * {id} params
 *
 * or route
 * '/articles/page/{page}/sort/{sort}'
 *
 * {page} .. {sort} params
 *
 *
 * params will be added
 * and available in the controller
 * automatically in the variable $this->data['page']|$this->data['sort']...
 *
 */


return [
    [
        'route' => '/test',
        'controller' => 'test',
        'method' => 'run',
        'access' => 'all'
    ],
    [
        'route' => '/',
        'controller' => 'home',
        'method' => 'index',
    ],
    [
        'route' => '/home',
        'controller' => 'home',
        'method' => 'index',
    ],
    [
        'route' => '/login',
        'controller' => 'authorization',
        'method' => 'login',
        'access' => 'all'
    ],
    [
        'route' => '/signin',
        'controller' => 'authorization',
        'requestMethod' => 'POST',
        'method' => 'signIn',
        'access' => 'all'
    ],
    [
        'route' => '/administration/users/create',
        'controller' => 'AdministrationUser',
        'requestMethod' => 'POST',
        'method' => 'create',
    ],
    [
        'route' => '/administration/users/update',
        'controller' => 'AdministrationUser',
        'requestMethod' => 'POST',
        'method' => 'update',
    ],
    [
        'route' => '/administration/users/all',
        'controller' => 'administrationUser',
        'method' => 'getAllUsersAndGroup',
    ],
    [
        'route' => '/administration/users/category/{categories}',
        'controller' => 'administrationUser',
        'method' => 'getAllUsersAndGroup',
    ],
    [
        'route' => '/administration/group/create',
        'controller' => 'AdministrationGroup',
        'requestMethod' => 'POST',
        'method' => 'create',
    ],
    [
        'route' => '/directory/car/create',
        'controller' => 'carPark',
        'requestMethod' => 'POST',
        'method' => 'create',
    ],
    [
        'route' => '/directory/car/update',
        'controller' => 'carPark',
        'requestMethod' => 'POST',
        'method' => 'update',
    ],
    [//Ajax request get (json) car models by id car brands
        'route' => '/directory/car/get/models',
        'controller' => 'carPark',
        'requestMethod' => 'POST',
        'method' => 'getCarModels',
    ],
    [//Ajax request get (json) new msg
        'route' => '/messages/get/new',
        'controller' => 'message',
        'requestMethod' => 'POST',
        'method' => 'getNew',
    ],
    [//Ajax request get one msg
        'route' => '/messages/get/one',
        'controller' => 'message',
        'requestMethod' => 'POST',
        'method' => 'getOne',
    ],
    [//Ajax request set msg is_read=true
        'route' => '/messages/set/read',
        'controller' => 'message',
        'requestMethod' => 'POST',
        'method' => 'setIsReadTrue',
    ],
    [
        'route' => '/logout',
        'controller' => 'authorization',
        'method' => 'logout',
    ],
    [
        'route' => '/directory/car-park',
        'controller' => 'carPark',
        'method' => 'allCars',
    ],
    [
        'route' => '/administration/settings',
        'controller' => 'administrationSettings',
        'method' => 'getAllSettings',
    ],
    [//Ajax request set settings user
        'route' => '/administration/settings/set/group',
        'controller' => 'administrationSettings',
        'requestMethod' => 'POST',
        'method' => 'setGroup',
        'access' => 'all'
    ],
    [//Ajax request set settings user
        'route' => '/administration/settings/set/user',
        'controller' => 'administrationSettings',
        'requestMethod' => 'POST',
        'method' => 'setUser',
        'access' => 'all'
    ],
    [//Ajax request get settings by id
        'route' => '/administration/settings/get/{settings}',
        'controller' => 'administrationSettings',
        'requestMethod' => 'POST',
        'method' => 'getSettById',
    ],
    [
        'route' => '/inspection/messages',
        'controller' => 'Message',
        'method' => 'showAll',
    ],
]











?>



