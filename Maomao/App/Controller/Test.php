<?php
namespace Maomao\App\Controller;

use Maomao\Core\Controller\Template as Controller_Template;

/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class Test extends Controller_Template{
    
    
    
    public function test()
    {
        $this->layout = 'test.php';
        $this->viewfile = 'test.php';
    }
    
}
