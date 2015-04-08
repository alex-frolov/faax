<?php
/**
 * Config as array
 *
 * @project FAAX
 * @author Alexander Frolov <alex.frolov@gmail.com>
 */
return [
// Include path and autoloader
// Add paths to the include path
'includePaths'        => [
    'controllers' => APPLICATION_PATH . "/Controllers",
    'models'      => APPLICATION_PATH . "/Models",
    'views'       => APPLICATION_PATH . "/Views",
],

// Router mapping
// 'nameOfRoute' = [route_type, route, controller, action, params=>['key'=>value,...]]
// route_type = ['static'];
'router'              => [
    'index' => [
        'route_type' => 'static',
        'route'      => 'index/index',
        'controller' => 'index',
        'action'     => 'index',
    ],
    'index2' => [
        'route_type' => 'static',
        'route'      => 'index',
        'controller' => 'index',
        'action'     => 'index',
    ],
    'error' => [
        'route_type' => 'static',
        'route'      => 'error',
        'controller' => 'error',
        'action'     => 'index',
    ],
],

// controller & action of error processing
'errorControllerName' => 'error',
'errorActionName'     => 'index',

// default controller & action
'indexControllerName' => 'index',
'indexActionName'     => 'index',
];