<?php
/**
 * \App\Core\Route
 * mapping routes into system, parse URI and fount controller & action.
 * If it doesn't fount any controller & action^ then return error controller and action
 * Also if URI is /, so it returns default controller and action
 *
 * @project FAAX
 * @author  Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

class Route
{

    public function parseUri($path, &$route_map)
    {
        if (!isset($path) || $path == '' || $path == '/') {
            // default path and default controller and action
            return [
                'controller' => $this->getControllerClass(\App\Core\Config::$config['indexControllerName']),
                'action'     => $this->getActionClass(\App\Core\Config::$config['indexActionName']),
                'raw_controller' => \App\Core\Config::$config['indexControllerName'],
                'raw_action' => \App\Core\Config::$config['indexActionName']
            ];
        }

        // remove first / and last /
        if ($path[0] == '/') {
            $path = substr($path,1);
        }

        if ($path[strlen($path)-1] == '/') {
            $path = substr($path,0,-1);
        }

        foreach ($route_map as &$route) {

            // if we found route, return results
            if (($result = $this->_compare($path, $route)) !== false) {
                return $result;
            }
        }

        // path not found, show error controller and action
        return [
            'controller' => $this->getControllerClass(\App\Core\Config::$config['errorControllerName']),
            'action'     => $this->getActionClass(\App\Core\Config::$config['errorActionName']),
            'raw_controller' => \App\Core\Config::$config['errorControllerName'],
            'raw_action' => \App\Core\Config::$config['errorActionName']
        ];
    }

    private function _compare($path, &$route)
    {

        switch ($route['route_type']) {


            // static route parse
            case 'static' :
            default:
                if ($route['route'] == $path) {
                    return [
                        'controller' => $this->getControllerClass($route['controller']),
                        'action'     => $this->getActionClass($route['action']),
                        'raw_controller' => $route['controller'],
                        'raw_action' => $route['action']
                    ];
                }
                break;
        }

        return false;
    }

    public function getControllerClass($name)
    {
        return '\App\Controllers\\' . ucfirst($name) . 'Controller';
    }

    public function getActionClass($name)
    {
        return strtolower($name) . 'Action';
    }
}