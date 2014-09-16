<?php
namespace Maomao\App\Controller;



/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class Pager extends Base{
    
    //public $tpl_layout = 'layout_default.tpl';
    
    public function top()
    {
        //$this->tpl_action = 'top.tpl';

    	$package = new \Maomao\App\Model\package();

    	var_dump($package->get_list_by_code("3"));
    }
    
}
