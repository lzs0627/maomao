<?php
namespace Maomao\Core\Controller;

use Maomao\Core\Object as Object;
use Maomao\Core\View\Base as View_Base;

class Template
{
    //class name
    public $name;
    
    //html layout
    public $tpl_layout = "layout_default.tpl";
    
    //html action 
    public $tpl_action;

    //params
    public $params;

    //template file extension
    public $tpl_ext = ".tpl";

    public function __construct($params = array()) {
        $this->name = substr(strrchr(get_class($this), "\\"), 1);
        $this->params = $params;
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

        if (! isset($this->tpl_action) || !$this->tpl_action) {
            $this->tpl_action = $action . $this->tpl_ext;
        }


    }


    public function render()
    {
//        extract((array)$this);

        ob_start();
        require APPPATH . 'View' . DS . $this->name . DS . $this->tpl_action;
        $layout_content = ob_get_clean();
        
        require APPPATH . 'View' . DS . 'Layout' . DS . $this->tpl_layout;

    }
}