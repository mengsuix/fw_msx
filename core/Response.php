<?php

namespace core;

class Response
{
    public function rend($data)
    {
        ob_start();
        echo $data;
        ob_end_flush();
    }
}