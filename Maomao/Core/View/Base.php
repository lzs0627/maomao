<?php
namespace Maomao\Core\View;

use Maomao\Core\Object as Object;

/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class Base extends Object{
    
    protected $controller;
    
    protected $action_content;
    
    public function __construct($controller) {

        $this->controller = $controller; 

    }
    
    public function render()
    {
        extract((array)$this->controller);

        ob_start();
        require APPPATH . 'View' . DS . $viewfile;
        $layout_content = ob_get_clean();
        
        require APPPATH . 'View' . DS . 'Layout' . DS . $this->tpl_layout;
    }
    
}
