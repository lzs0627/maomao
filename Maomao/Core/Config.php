<?php

namespace Maomao\Core;

/**
 * Config：フレームワーク（Core）の設定に使う。
 *
 * @author lizhaoshi
 */
class Config extends Object {

    /**
     *
     * @var Array
     */
    protected static $dataStore = array();

    /**
     *
     * @var Array
     */
    protected static $dataCache = array();

    /**
     *
     * @param  String $key     "."で繋ぐ文字列
     * @param  mixed  $default
     * @return mixed  Description
     */
    public static function get($key, $default = null) {
        if (is_null($key)) {
            return static::$dataStore;
        }

        if (isset(static::$dataStore[$key])) {
            return static::$dataStore[$key];
        } elseif (isset(static::$dataCache[$key])) {
            return static::$dataCache[$key];
        }

        $keys = explode('.', $key);
        $arr = static::$dataStore;

        foreach ($keys as $key) {
            if (!isset($arr[$key])) {
                $arr = $default;
                break;
            } else {
                $arr = $arr[$key];
            }
        }

        static::$dataCache[$key] = $arr;

        return $arr;
    }

    /**
     * @param string $key   "."で繋ぐ文字列
     * @param mixd   $value 保存する値
     */
    public static function set($key, $value) {
        if (is_string($key)) {

            if (isset(static::$dataCache[$key])) {
                unset(static::$dataCache[$key]);
            }

            $keys = explode('.', $key);
            $arr = & static::$dataStore;

            while (count($keys) > 1) {
                $key = array_shift($keys);

                if (!isset($arr[$key]) || !is_array($arr[$key])) {
                    $arr[$key] = array();
                }

                $arr = & $arr[$key];
            }

            $arr[array_shift($keys)] = $value;
        } else {
            throw new \InvalidArgumentException("key must be a dot-notated string.");
        }
    }

    public static function setup($default_path, $target_path) {
        $default_config_set = array();
        $default_files = new \DirectoryIterator($default_path);

        foreach ($default_files as $f) {
            if ($f->isFile() && $f->getExtension() == 'php') {
                $k = $f->getBasename('.php');
                $default_config_set[strtolower($k)] = include $f->getPathname();
            }
        }

        $target_config_set = array();
        $target_files = new \DirectoryIterator($target_path);

        foreach ($target_files as $f) {
            if ($f->isFile() && $f->getExtension() == 'php') {
                $k = $f->getBasename('.php');
                $target_config_set[strtolower($k)] = include $f->getPathname();
            }
        }

        foreach ($default_config_set as $k => $config) {
            if (isset($target_config_set[$k])) {
                $config = array_replace_recursive($config, $target_config_set[$k]);
                static::set($k, $config);
                unset($target_config_set[$k]);
            } else {
                static::set($k, $config);
            }
        }

        if (count($target_config_set) > 0) {
            foreach ($target_config_set as $k => $config) {
                static::set($k, $config);
            }
        }
    }

}
