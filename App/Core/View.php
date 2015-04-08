<?php
/**
 * \App\Core\View
 * view render with controller action parameters
 * It has not any template engine like smarty/twig...
 * Only raw render.
 *
 * @project FAAX
 * @author  Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

class View
{
    public function render($params, $controller, $action)
    {
        $view_path = APPLICATION_PATH . '/Views/' . strtolower($controller) . '/' . strtolower($action) . '.php';

        @include $view_path;
    }
}