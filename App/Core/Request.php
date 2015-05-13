<?php
/**
 * Request
 * Store post/get/request/server variables
 * default values from $_POST/$_GET/$_REQUEST/$_SERVER
 * but if you write self app for unit tests you can set up these variables directly.
 *
 * @project    FAAX
 * @category   Core
 * @package    Request
 * @copyright  Copyright (c) 2015 Aleksander Frolov. (http://www.frolov.guru)
 * @author     Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

class Request
{
    public static $post    = null;
    public static $get     = null;
    public static $request = null;
    public static $server  = null;

    public static function initParams(&$post, &$get, &$request, &$server){
        if (isset($post)) {
            self::$post = $post;
        }

        if (isset($get)) {
            self::$get = $get;
        }

        if (isset($request)) {
            self::$request = $request;
        }

        if (isset($server)) {
            self::$server = $server;
        }
    }
}