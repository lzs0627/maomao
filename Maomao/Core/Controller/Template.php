<?php
namespace Maomao\Core\Controller;

use Maomao\Core\Object as Object;
use Maomao\Core\View\Base as View_Base;

class Template extends Object
{
    //class name
    protected $name;
    
    //html layout
    protected $layout;
    
    //html action 
    protected $viewfile;

    // view data
    protected $data;


    public function __construct() {
        $this->name = substr(strrchr(get_class($this), "\\"), 1);
        $this->data = array();
    }
    
    protected function beforeAction()
    {
        
    }
    
    protected function afterAction()
    {
        
    }
    
    public function loadAction($action)
    {
        $this->beforeAction();
        
        $this->$action();
        
        $this->afterAction();
        
        $ViewBase = new View_Base($this->layout, $this->data);
        
        $ViewBase->render($this->name . DS . $this->viewfile);
    }
}