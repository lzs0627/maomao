<?php
namespace Maomao\Core\Database;

use \Maomao\Core\Config as Config;
use \Maomao\Core\Object as Object;
/**
 * Description of DB
 *
 * @author lizhaoshi
 */
class DB extends Object
{
    /**
     *
     * @var type
     */
    public static $instances = array();

    /**
     *
     * @param  type                      $name
     * @param  array                     $config
     * @return type
     * @throws \UnexpectedValueException
     */
    public static function instance($name = null, array $config = null)
    {
        if ($name === null) {
            $name = Config::get("db.active");
        }

        if (! isset(static::$instances[$name])) {
            if ($config === null) {
                $config = Config::get("db.{$name}");
            }

            if ( ! isset($config['type'])) {
                throw new \UnexpectedValueException(
                        'Database type not defined '
                        . 'in "'.$name.'" configuration or "'.$name.'" '
                        . 'configuration does not exist');
            }

            $db_driver = '\\Maomao\\Core\\Database\\Driver\\' . ucfirst($config['type']);
            static::$instances[$name] = new $db_driver($name, $config);
        }

        return static::$instances[$name];
    }
}
