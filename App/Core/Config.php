<?php
/**
 * Config
 * processing config data
 *
 * @project FAAX
 * @author  Alexander Frolov <alex.frolov@gmail.com>
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
}