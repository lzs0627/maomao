<?php
namespace Maomao\Core\View;

use Maomao\Core\Object as Object;

/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class Base extends Object{
    
    protected $layout;
    
    protected $data;
    
    
    public function __construct($layout, $data) {
        
        $this->layout = $layout;
        $this->data = $data;
        
    }
    
    public function render($viewfile)
    {
        extract($this->data);

        ob_start();
        require APPPATH . 'View' . DS . $viewfile;
        $layout_content = ob_get_clean();
        
        require APPPATH . 'View' . DS . 'Layout' . DS . $this->layout;
    }
    
}
