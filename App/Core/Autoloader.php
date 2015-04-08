<?php
/**
 * Autoload classes
 * default path to \App\Models
 * But you can say full name of class with namespaces like \App\Controllers\IndexController
 *
 * @project FAAX
 * @author  Alexander Frolov <alex.frolov@gmail.com>
 */
namespace App\Core;

class Autoloader
{
    public function __construct()
    {
    }

    public static function autoload($file)
    {
        $path = APPLICATION_PATH . '/../';
        if (substr($file, 0, 4) == 'App\\') {
            $file = substr($file, 4);
        }

        $tmp = explode('\\', $file);
        $file = str_replace('\\', '/', $file);
        if (!isset($tmp[1])) {
            $filepath = \App\Core\Config::$config['includePaths']['models'] . '/' . $file . '.php';
        } else {
            $filepath = APPLICATION_PATH . '/' . $file . '.php';
        }

        if (file_exists($filepath)) {
            require_once($filepath);
        } else {
            $flag = true;
            Autoloader::recursive_autoload($file, $path, $flag);
        }
    }

    public static function recursive_autoload($file, $path, &$flag)
    {
        if (FALSE !== ($handle = opendir($path)) && $flag) {

            while (FAlSE !== ($dir = readdir($handle)) && $flag) {

                if (strpos($dir, '.') === FALSE) {
                    $path2 = $path . '/' . $dir;
                    $filepath = $path2 . '/' . $file . '.php';
                    if (file_exists($filepath)) {
                        $flag = FALSE;
                        require_once($filepath);
                        break;
                    }
                    Autoloader::recursive_autoload($file, $path2, $flag);
                }
            }

            closedir($handle);
        }
    }
}

\spl_autoload_register('App\Core\Autoloader::autoload');
