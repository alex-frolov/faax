<?php
/**
 * \App\Core\View
 * view render with controller action parameters
 * It has not any template engine like smarty/twig...
 * Only raw render.
 *
 * @project    FAAX
 * @category   Core
 * @package    View
 * @copyright  Copyright (c) 2015 Aleksander Frolov. (http://www.frolov.guru)
 * @author     Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

class View extends \App\Core\Instance
{
    public function render($params, $controller, $action)
    {
        $view_path = APPLICATION_PATH . '/Views/' . strtolower($controller) . '/' . strtolower($action) . '.php';

        @include $view_path;
    }
}