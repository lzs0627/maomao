<?php

namespace Maomao\Core;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    
    public function testparse()
    {
        $uri = 'sample/hello/20';
        
        $r = Router::parse($uri);
        
        $this->assertTrue($r['controller'][0] === 'Sample');
        $this->assertTrue($r['controller'][1] === 'index');
        $this->assertTrue($r['params']['name'] === 'hello');
        $this->assertTrue($r['params']['id'] === '20');
    }
    
    public function testIparse()
    {
        $r = Router::iparse('_sample_', array('name'=>'li','id'=>20));
        
        $this->assertTrue($r === '/sample/li/20/');
    }
}