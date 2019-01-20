<?php
/**
 * Created by PhpStorm.
 * User: msx
 * Date: 2018/12/21
 * Time: 上午9:42
 */
namespace app\controller;

class Controller
{
    public $assignStore = [];

    public function __construct()
    {
    }

    public function assign($varName, $var)
    {
        $this->assignStore[$varName] = $var;
    }

    public function display($path)
    {
        $filePath = APP . '/view/' . $path;
        if (is_file($filePath)) {
            extract($this->assignStore);
            include $filePath;
        }
    }
}