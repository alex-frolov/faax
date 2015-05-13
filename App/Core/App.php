<?php
/**
 * \App\Core\App
 * Main application class for run.
 *
 * @project    FAAX
 * @category   Core
 * @package    Autoloader
 * @copyright  Copyright (c) 2015 Aleksander Frolov. (http://www.frolov.guru)
 * @author     Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

class App {

    protected $_autoloader;
    protected $_bootstrap;

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

        if (self::$_config->hasOption('php_ini')) {
            $this->setPhpSettings(self::$_config->getOption('php_ini'));
        }

        // set classes autoloading
        require_once(APPLICATION_PATH . '/Core/Autoloader.php');
        $this->_autoloader = \App\Core\Autoloader::getInstance();
    }

    /**
     * Retrieve autoloader instance
     *
     * @return Autoloader
     */
    public function getAutoloader()
    {
        return $this->_autoloader;
    }

    /**
     * Retrieve application options
     *
     * @return array
     */
    public function getConfig()
    {
        return self::$_config;
    }


    /**
     * Set include path
     *
     * @param  array $paths
     */
    public function setIncludePaths(array $paths)
    {
        $path = implode(PATH_SEPARATOR, $paths);
        set_include_path($path . PATH_SEPARATOR . get_include_path());
    }

    /**
     * Set PHP configuration settings
     *
     * @param  array $settings
     * @param  string $prefix Key prefix to prepend to array values
     */
    public function setPhpSettings(array $settings, $prefix = '')
    {
        foreach ($settings as $key => $value) {
            $key = empty($prefix) ? $key : $prefix . $key;
            if (is_scalar($value)) {
                ini_set($key, $value);
            } elseif (is_array($value)) {
                $this->setPhpSettings($value, $key . '.');
            }
        }
    }

    public function setBootstrap()
    {
        if (self::$_config->hasOption('bootstrap_file')) {
            $bootsrap_file = self::$_config->getOption('bootstrap_file');
            try {

                if (!is_file($bootsrap_file)) {
                    throw new Exception('Bootstrap not found by ' . $bootsrap_file);
                }

                if (!is_readable($bootsrap_file)) {
                    throw new Exception('Bootstrap file not readable by ' . $bootsrap_file);
                }

                include_once($bootsrap_file);
                $this->_bootstrap = \App\Bootstrap::getInstance();

            } catch (Exception $e) {
                echo $e->getMessage(), "\n";
                exit();
            }
        }
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
        \App\Core\App::$path = $route->parseUri(\App\Core\Request::$server['REQUEST_URI'], \App\Core\Config::$config['router']);

        // init view
        self::$view = new \App\Core\View();

        // run customize users bootstrap
        $this->_bootstrap = \App\Bootstrap::getInstance();
        $this->_bootstrap->run();

        // include controller file
        $path = self::$path;
        $oController = new $path['controller'];

        // view render from controller/action results and view template
        self::$view->render($oController->$path['action'](), $path['raw_controller'], $path['raw_action']);
    }
}