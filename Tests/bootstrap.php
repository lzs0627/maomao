<?php
/**
 * webroot bootstrap
 */

define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);

define('ENV', 'Test');

//app root
define('APPPATH', realpath(__DIR__.'/../Maomao/Apps') . DS);

//core root
define('COREPATH', realpath(__DIR__.'/../Maomao/Core') . DS);

// Boot the core
require APPPATH.'Bootstrap.php';
