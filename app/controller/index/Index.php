<?php
/**
 * Created by PhpStorm.
 * User: msx
 * Date: 2018/12/20
 * Time: 下午3:39
 */
namespace app\controller\index;

use \app\controller\Controller;

class Index extends Controller
{
    public function main()
    {
        $this->assign('data', 'mengsuixing');
        $this->display('index/index.html');
    }
}