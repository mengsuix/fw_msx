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
        $mysql = new Mysql('127.0.0.1', 'user', 'root', '4305819');
        $data = $mysql->table('student')->field('id,name,birth')->where('sex', '=', '1')->select();
        var_dump($data);
    }
}