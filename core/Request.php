<?php

namespace core;

class Request
{
    private $request_uri;

    public function get()
    {

    }
    public function post()
    {

    }
    public function any()
    {

    }

    public function routePath()
    {
        if (!empty($this->request_uri)) {
            return $this->request_uri;
        }
        $this->request_uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        return $this->request_uri;
    }
}