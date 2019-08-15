<?php

namespace core;

class App
{
    private $request;
    private $route;

    public function __construct()
    {
        $this->request = app(Request::class);
        $this->route = app(Route::class);
    }

    public function handle()
    {
        $routePath = $this->request->routePath();
        $routeResult = $this->route->match($routePath);
        return $this->exec($routeResult);
    }

    private function exec($param)
    {
        $controller = $param['class'];
        $method = $param['method'];
        $object = new $controller();
        $result = call_user_func([$object, $method]);
        return $result;
    }
}