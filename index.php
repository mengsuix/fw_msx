<?php
//定义常量
define('ROOT', dirname(__FILE__));
define('CORE', ROOT . '/core');
define('APP', ROOT . '/app');
define('COMMON', ROOT . '/common');
define('ROUTE', ROOT . '/route');
//加载启动代码
include CORE . '/Init.php';
include COMMON . '/functions.php';
spl_autoload_register('\core\Init::load');
//实例化容器
$container = new \core\Container();
//获取app实例
$app = $container->get(\core\App::class);
$response = $container->get(\core\Response::class);
$response->rend($app->handle());