<?php

define('DS', DIRECTORY_SEPARATOR);

if (getenv('SYS_ENV')) {
    define('ENV', getenv('SYS_ENV'));
} else {
    define('ENV', 'Develope');
}

//app root
define('APPPATH', realpath(__DIR__.'/../../Apps') . DS);

//core root
define('COREPATH', realpath(__DIR__.'/../../Core') . DS);

// Boot the core
require APPPATH.'Bootstrap.php';
