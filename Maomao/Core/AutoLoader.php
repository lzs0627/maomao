<?php
namespace Maomao\Core;

/**
 * Description of AutoLoader
 *
 * @author lizhaoshi
 */
class AutoLoader
{
    /**
     *
     */
    protected static $namespaces = array();

    /**
     *
     * @param type $namespage
     * @param type $path
     */
    public static function addNamespage($namespage, $path)
    {
        static::$namespaces[$namespage] = $path;
    }

    /**
     *
     * @var type
     */
    protected static $classes = array();

    /**
     *
     * @param type $class
     * @param type $path
     */
    public static function addClass($class, $path)
    {
        static::$classes[$class] = $path;
    }

    /**
     *
     */
    public static function register()
    {
        spl_autoload_register('Maomao\\Core\\Autoloader::load', true, true);
    }

    /**
     * PSR-0,PSR-4の規則に従う.
     * @param  type    $class
     * @return boolean
     */
    public static function load($class)
    {
        if (strpos($class, 'static::') === 0) {
            return true;
        }

        $loaded = false;
        $class = ltrim($class, '\\');

        //static::$classesが優先チェック
        if (isset(static::$classes[$class])) {
            include realpath(static::$classes[$class]);
            $loaded = true;
        } else {
            foreach (static::$namespaces as $ns => $path) {
                $ns = ltrim($ns, '\\');
                $len = strlen($ns);

                if (strncmp($ns, $class, $len) !== 0) {
                    continue;
                }

                // get the relative class name
                $realname = $class = substr($class, $len);
                $prefix = '';
                $pos = strrpos($realname, '\\');

                if ($pos !== false) {
                    $realname = substr($class, $pos + 1);
                    $prefix = substr($class, 0, $pos + 1);
                }

                $subpath = str_replace('\\', DS, rtrim($prefix, '\\'));

                if ($subpath) {
                    $subpath .= DS;
                }

                $class_file_name = str_replace('_', DS, $realname) . '.php';
                $class_file_path = $path . $subpath . $class_file_name;

                if (file_exists($class_file_path)) {

                    require $class_file_path;
                    $loaded = true;
                }
            }

        }

        return $loaded;
    }

}
