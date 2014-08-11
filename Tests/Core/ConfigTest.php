<?php
namespace Maomao\Core;

/**
 * Description of ConfigTest
 *
 * @author lizhaoshi
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAndSet()
    {

        $db = Config::get('db');
        
        $this->assertTrue(is_array($db));
        $this->assertTrue(Config::get('db.active') === 'default');
    }

}
