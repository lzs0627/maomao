<?php
namespace Maomao\App\Controller;

use Maomao\Core\Controller\Template as Controller_Template;

/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class Error extends Controller_Template{
    
    
    
    public function notFound()
    {
        $this->tpl_layout = 'test.php';
        $this->tpl_action = 'not_found.php';
    }
    
}
