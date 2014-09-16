<?php
namespace Maomao\Core;

/**
 * Description of Router
 *
 * @author lizhaoshi
 */
class Router extends Object{
    
    /**
     * uriからroute情報を返す
     * @param type $uri
     * @return boolean
     */
    public static function parse($uri = null)
    {
        if(! $uri) {
            $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        }
        $uri = rtrim(rtrim(trim(trim($uri),'/')),'/');
        $routes = Config::get('route');
        
        if (! $routes) {
            return false;
        }
        
        $mapping = array();
        
        foreach ($routes as $id => $setting) {
            $match = rtrim(rtrim(trim(trim($setting['match']),'/')),'/');
            $match = str_replace('/', '\/', $match);
            
            if (! preg_match('/^'.$match.'$/', $uri, $params)) {
                continue;
            }
            
            foreach ($setting['params'] as $i=>$k) {
                if (isset($params[$i+1])) {
                    $mapping['params'][$k] = $params[$i+1];
                }
            }
            
            $mapping['controller'] = $setting['controller'];
            
            return $mapping;
        }
        
        return false;
    }
        
    /**
     * URLを返す
     * @param type $id
     * @param type $params
     */
    public static function iparse($id, $params = null)
    {
        $routes = Config::get('route');
        
        foreach ($routes as $k => $setting) {
            if ($k != $id) {
                continue;
            }
            
            if (!$params && $setting['params']) {
                return false;
            }
            
            $match = rtrim(rtrim(trim(trim($setting['match']),'/')),'/');
            
            $p = array();
            foreach ($setting['params'] as $v) {
                $match = preg_replace('/\([^\/]*\)/', '{'.$v.'}', $match, 1);
            }
            
            foreach ($params as $k=>$v) {
                $match = str_replace('{'.$k.'}', $v, $match);
            }
            
            return '/'.$match.'/';
            
            
        }
        
        return false;
    }
    
}
