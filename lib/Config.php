<?php
/**
 * Created by PhpStorm.
 * User: vovan
 * Date: 01.05.2018
 * Time: 11:13
 */
namespace lib;

class Config
{
    protected static $settings = [];

    /**
     * @param $key
     * @return mixed|null
     */
    public static function get($key) {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value) {
        self::$settings[$key] = $value;
    }
}