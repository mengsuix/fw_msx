<?php
/**
 * Created by PhpStorm.
 * User: msx
 * Date: 2018/12/20
 * Time: 下午3:39
 */
namespace app\controller\index;

use app\controller\Controller;
use core\Mysql;

class Index extends Controller
{
    public function main()
    {
        var_dump('cdc');
        $mysql = new Mysql('127.0.0.1', 'user', 'root', '4305819');

//        $this->assign('data', 'mengsuixing');
//        $this->display('index/index.html');
    }
}