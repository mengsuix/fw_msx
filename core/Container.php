<?php

namespace core;

class Container
{
    private static $container;

    public function __construct()
    {
        self::$container[stripslashes(Container::class)] = $this;
    }

    public function set($class)
    {
        $key = stripslashes($class);
        if (!isset(self::$container[$key])) {
            self::$container[$key] = new $class();
        }
        return true;
    }

    public function get($class)
    {
        $key = stripslashes($class);
        if (!isset(self::$container[$key])) {
            self::$container[$key] = new $class();
        }
        return self::$container[$key];
    }

    public function delete($class)
    {
        $key = stripslashes($class);
        if (isset(self::$container[$key])) {
            unset(self::$container[$key]);
            return true;
        } else {
            return false;
        }
    }

    public static function getContainer()
    {
        return self::$container[stripslashes(Container::class)];
    }
}