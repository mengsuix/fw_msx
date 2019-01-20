<?php
/**
 * Created by PhpStorm.
 * User: msx
 * Date: 2018/12/19
 * Time: 下午8:40
 */
namespace core;

class Init
{
    static public $classMap = [];

    static public function run()
    {
        $routeObj = new \core\Route();
        $controllerPath = 'app\controller\\' . $routeObj->resource['list'] . '\\' . ucwords($routeObj->resource['controller']);
        $controllerObj = new $controllerPath();
        $method = $routeObj->resource['method'];
        $controllerObj->$method();
    }

    /**
     * 加载类
     * @param $className
     * @return bool
     */
    static public function load($className)
    {
        if (isset(self::$classMap[$className])) {
            return true;
        }
        $className = str_replace('\\', '/', $className);
        $fileName = ROOT . '/' .$className . '.php';
        if (is_file($fileName)) {
            include $fileName;
            self::$classMap[$className] = $className;
        } else {
            return false;
        }
        return true;
    }
}