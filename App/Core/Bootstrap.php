<?php
/**
 * Bootstrap abstract class
 *
 * @project    FAAX
 * @category   Core
 * @package    Bootstrap
 * @copyright  Copyright (c) 2015 Aleksander Frolov. (http://www.frolov.guru)
 * @author     Aleksander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

abstract class Bootstrap
{
    abstract public function run();

    /**
     * @var Singleton instance
     */
    protected static $_instance;

    /**
     * Retrieve singleton instance
     *
     * @return Bootstrap
     */
    public static function getInstance()
    {
        if (static::$_instance === NULL || get_class(static::$_instance) != get_called_class()) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    /**
     * Reset the singleton instance
     *
     * @return void
     */
    public static function resetInstance()
    {
        self::$_instance = null;
    }

}