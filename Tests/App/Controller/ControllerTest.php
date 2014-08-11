<?php


/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class ControllerTest extends \PHPUnit_Framework_TestCase {
    
    public function testLoadLayout()
    {
        $controller = new \Maomao\App\Controller\Test();
        
        $controller->loadAction('test');
        
    }
    
}
