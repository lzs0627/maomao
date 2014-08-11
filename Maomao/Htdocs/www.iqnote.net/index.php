<?php

define('DS', DIRECTORY_SEPARATOR);

if (getenv('MAOMAO_ENV')) {
    define('ENV', getenv('MAOMAO_ENV'));
} else {
    define('ENV', 'Develope');
}

//app root
define('APPPATH', realpath(__DIR__.'/../../App') . DS);

//core root
define('COREPATH', realpath(__DIR__.'/../../Core') . DS);

// Boot the core
require APPPATH.'Bootstrap.php';

$dispatcher = new \Maomao\Core\Dispatcher();
$dispatcher->dispatch();