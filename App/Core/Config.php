<?php
/**
 * Config
 * processing config data
 *
 * @project    FAAX
 * @category   Core
 * @package    Config
 * @copyright  Copyright (c) 2015 Aleksander Frolov. (http://www.frolov.guru)
 * @author     Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

class Config
{

    public static $config = false;

    public function setConfig(&$config_path)
    {

        try {
            if (!is_file($config_path)) {
                throw new Exception('File not found by path: ' . $config_path);
            }

            if (!is_readable($config_path)) {
                throw new Exception('File not readable by path: ' . $config_path);
            }

            self::$config = include($config_path);

            if (self::$config === false) {
                throw new Exception('Can not recognize config by: ' . $config_path);
            }

        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
            exit();
        }
    }

    /**
     * Is an option present into config?
     *
     * @param  string $key
     * @return bool
     */
    public function hasOption($key)
    {
        return array_key_exists($key, self::$config);
    }

    /**
     * Retrieve a single option
     *
     * @param  string $key
     * @return mixed
     */
    public function getOption($key)
    {
        if ($this->hasOption($key)) {
            return self::$config[$key];
        }
        return null;
    }
}