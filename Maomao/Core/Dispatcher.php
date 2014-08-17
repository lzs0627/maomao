<?php

namespace Maomao\Core;

/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class Dispatcher extends Object{
    
    protected $webroot;
    const CONTROLLER_NAMESPACE = "\\Maomao\\App\\Controller\\";

    public function __construct($webroot = '') 
    {
        $this->webroot = trim($webroot, '/');
    }
    
    public function dispatch()
    {
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');

        if ($this->webroot) {
            $uri = trim($uri, '/');
            $uri = preg_replace('/^'.$this->webroot.'/', '', $uri);
        }
        
        $r = Router::parse($uri);
        
        if ($r && isset($r['controller'][0]) && isset($r['controller'][1])) {
            
            $constucter = static::CONTROLLER_NAMESPACE . ucfirst($r['controller'][0]);
            $action = $r['controller'][1];
            $params = isset($r['params']) ? $r['params'] : array();
            $controller = new $constucter($params);
            $controller->loadAction($action);
            
        } else {
            if (class_exists(static::CONTROLLER_NAMESPACE.'Error')) {
                $error_controller = static::CONTROLLER_NAMESPACE.'Error';
                $controller = new $error_controller();
                $controller->loadAction('notFound');
            } else {
                Controller\Error::notfound();
            }
            
        }
    }
    
}
