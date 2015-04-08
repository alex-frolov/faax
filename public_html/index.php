<?php
/**
 * start file
 *
 * @project FAAX
 * @author  Alexander Frolov <alex.frolov@gmail.com>
 */

// small tweaks :)
ini_set('error_reporting', E_ALL ^ E_NOTICE);
date_default_timezone_set('Europe/Moscow');
set_time_limit(100);

// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../App'));

// setup path for looking for files, php files
set_include_path(implode(PATH_SEPARATOR, array(realpath(APPLICATION_PATH . '/../App'), get_include_path())));

// run application
require_once APPLICATION_PATH . '/App.php';
$app = new \App\App (APPLICATION_PATH . '/Configs/config.php');
$app->run($_REQUEST, $_POST, $_GET, $_SERVER);
