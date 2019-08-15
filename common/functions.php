<?php

/**
 * 从容器解析
 * @param $class
 * @return mixed
 */
function app($class)
{
    $container = \core\Container::getContainer();
    return $container->get($class);
}