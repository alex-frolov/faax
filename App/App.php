<?php
/**
 * \App\App
 * Main application class for run.
 *
 * @project FAAX
 * @author  Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App;

class App {

    /**
     * Config object
     * @var \App\Core\Config|bool
     */
    private static $_config = false;

    /**
     * @var array = ['controller'=>'\App\Controllers\IndexController', 'action'=>'indexAction', 'raw_controller'=>'index', 'raw_action'=>'index']
     */
    public static $path = false;

    /**
     * View object
     * @var bool|\App\Core\View
     */
    public static $view = false;

    public function __construct($config_path) {

        // load config
        require_once(APPLICATION_PATH . '/Core/Config.php');
        self::$_config = new \App\Core\Config();
        self::$_config->setConfig($config_path);

        // set classes autoloading
        require_once(APPLICATION_PATH . '/Core/Autoloader.php');
    }

    /**
     * run application, require some variables
     *
     * @param array $request - $_REQUEST
     * @param array $post - $_POST
     * @param array $get - $_GET
     * @param array $server - $_SERVER
     */
    public function run(&$request, &$post, &$get, &$server) {

        // setup request params
        \App\Core\Request::initParams($post, $get, $request, $server);

        // parse route
        $route = new \App\Core\Route();
        \App\App::$path = $route->parseUri(\App\Core\Request::$server['REQUEST_URI'], \App\Core\Config::$config['router']);

        // init view
        self::$view = new \App\Core\View();

        // include controller file
        $path = self::$path;
        $oController = new $path['controller'];

        // view render from controller/action results and view template
        self::$view->render($oController->$path['action'](), $path['raw_controller'], $path['raw_action']);
    }
}