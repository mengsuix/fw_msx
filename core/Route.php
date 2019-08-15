<?php
namespace core;

class Route
{
    private static $map;

    public function __construct()
    {
        $directory = array_slice(scandir(ROUTE), 2);
        foreach ($directory as $value) {
            require ROUTE . '/' .$value;
        }
    }

    public function match($routePath)
    {
        if (isset(self::$map[$routePath])) {
            return self::$map[$routePath];
        } else {
            return [];
        }
    }

    public static function get($path, $handle)
    {
        if ('get') {
            self::saveInMap($path, $handle);
        }
    }

    public static function post($path, $handle)
    {

    }

    public static function any($path, $handle)
    {

    }

    private static function saveInMap($path, $handle)
    {
        if (is_callable($handle)) {
            call_user_func($handle);
        } else {
            $tmp = explode('@', $handle);
            $class = $tmp[0];
            $method = $tmp[1];
            self::$map[$path] = [
                'request_method' => 'GET',
                'class' => $class,
                'method' => $method
            ];
        }
    }
}