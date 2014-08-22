<?php
namespace Maomao\Core\Model;

/**
 * Description of ConfigTest
 *
 * @author lizhaoshi
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    public function testForgeCondition()
    {

        $str = Base::forge_condition(array(
        		'c2.filed1='=>'(ok)',
        		'c3.filed2 <>' =>Base::NO_ESCAPE_PREFIX.'(ok)',
        		'or' => array(
        				'c2.field3='=>1,
        				'c4.field=' =>"ok'dd"
        			)
        	));
        var_dump($str);
    }

    public function testSelect()
    {
    	$model = new Base();

    	echo $model->select(array('c.x1', 'c2.x2'=>'x2'))
    				->from(array('table1'=>'t1'))
    				->where(array('x2='=>2))
    				->limit(0, 10)
    				->execute();
    }


}
