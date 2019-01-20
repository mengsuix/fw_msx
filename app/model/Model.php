<?php
/**
 * Created by PhpStorm.
 * User: msx
 * Date: 2018/12/21
 * Time: 上午10:29
 */
namespace app\model;

class Model extends \PDO
{
    public function __construct()
    {
        $dsn = 'mysql:host=192.168.10.23;dbname=data';
        $username = 'root';
        $passwd = '';
        try {
            parent::__construct($dsn, $username, $passwd);
        } catch(\PDOException $e) {
            varDebug($e->getMessage());
        }
    }
}