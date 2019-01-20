<?php
/**
 * 入口文件
 */
define('ROOT', dirname(__FILE__));
define('CORE', ROOT . '/core');
define('APP', ROOT . '/app');
define('COMMON', ROOT . '/common');
define('DEBUG', true);
if (DEBUG) {
    ini_set('display_errors', 'On');
} else {
    ini_set('display_errors', 'Off');
}
include COMMON . '/functions.php';
include APP . '/controller/Controller.php';
include CORE . '/Init.php';
spl_autoload_register('\core\Init::load');
\core\Init::run();