<?php
namespace Maomao\Core;

/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class Model extends Object
{
    /**
     *
     * @var type
     */
    protected $propoties = array();

    /**
     *
     * @param type $name
     * @param type $arguments
     */
    public function __call($name, $arguments)
    {
        if (strpos($name, 'set') === 0) {

        } elseif (strpos($name, 'get') === 0) {

        } else {
            throw new \Exception($name . " Method was not found.");
        }
    }

}
