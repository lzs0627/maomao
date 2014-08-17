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
        $this->layout = 'test.php';
        $this->viewfile = 'not_found.php';
    }
    
}
