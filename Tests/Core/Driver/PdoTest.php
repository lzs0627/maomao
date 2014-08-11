<?php
namespace Maomao\Core;

/**
 * Description of PdoTest
 *
 * @author lizhaoshi
 */
class PdoTest extends \PHPUnit_Framework_TestCase{
    
    public $db_config = array(
                    'type'=>'pdo',
                    'connection'=>array(
                        'dsn'        => 'mysql:dbname=denali_shopsite1000;host=192.168.243.10;port=3306',
                        'username'   => 'denaliuser',
                        'password'   => 'o6A#WkyQ',
                        'persistent' => false,
                        'compress'   => false,
                    ),
                    'charset'=>'utf8'
                );
    
    public function testSelect()
    {
        //$pdo = new Database\Driver\Pdo('pdo_connection', $this->db_config);
        
        //$sql = "Select * From s_shopsite where shopsiteid=1000";
        
        //$result = $pdo->query($sql);
                
        //$this->assertTrue(count($result) > 0);
        
    }
    
}
