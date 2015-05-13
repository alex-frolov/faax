<?php
/**
 * \App\Core\Instance
 *
 * @project    FAAX
 * @category   Core
 * @package    Instance
 * @copyright  Copyright (c) 2015 Aleksander Frolov. (http://www.frolov.guru)
 * @author     Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

class Instance
{
    /**
     * @var Singleton instance
     */
    protected static $_instance;

    /**
     * Retrieve singleton instance
     *
     * @return link to Object
     */
    public static function getInstance()
    {
        if (static::$_instance === NULL || get_class(static::$_instance) != get_called_class()) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }
}