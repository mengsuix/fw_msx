<?php
/**
 * Created by PhpStorm.
 * User: msx
 * Date: 2018/12/19
 * Time: 下午8:52
 */
namespace core;

class Route
{
    public $resource = [];

    public function __construct()
    {
        //去掉最左端'/'分隔符
        $requestUri = trim($_SERVER['REQUEST_URI'], '/');
        //以'/'为标志，打散uri为数组
        $requestUri = explode('/', $requestUri);
        $this->resource['list'] = $requestUri[0] ?: 'default';
        $this->resource['controller'] = $requestUri[1] ?: 'default';
        $this->resource['method'] = $requestUri[2] ?: 'main';
    }
}