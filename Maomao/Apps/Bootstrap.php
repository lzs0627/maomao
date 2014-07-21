<?php
use Maomao\Core\AutoLoader as AutoLoader;
use Maomao\Core\Config as Config;
/**
 * app bootstrap
 */
require COREPATH . 'AutoLoader.php';

//class_alias('Maomao\\Core\\AutoLoader', 'AutoLoader');

// Boot the core
require COREPATH.'bootstrap.php';

//register autoload
AutoLoader::register();

Config::setup(APPPATH . DS . 'Config', APPPATH . DS . 'Config' . DS . ENV);

if (Config::get('system.debug') === true) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
}
