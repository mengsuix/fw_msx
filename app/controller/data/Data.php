<?php
/**
 * Created by PhpStorm.
 * User: msx
 * Date: 2018/12/21
 * Time: 上午9:48
 */
namespace app\controller\data;

use \app\controller\Controller;
use \app\model\Model;

class Data extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function main()
    {
        $model = new Model();
        print_r(get_class_methods($model));
//        $query = "SELECT * FROM testing";
//        $result = $model->query($query);
//        varDebug($result);
    }
}