<?php


namespace app\controller;


use app\BaseController;
use think\facade\Db;

class Sql extends BaseController
{

    static $table_name = 'typecho_talk';
    public function test_select_find() {
        $sql = Db::table(static::$table_name)->where('id', 1)->fetchSql(true)->find();
        assertTrue($sql == "SELECT * FROM `{$this::$table_name}` WHERE  `id` = 1 LIMIT 1", $sql);
    }

    public function test_select_all() {
        $sql = Db::table(static::$table_name)->fetchSql(true)->select();
        assertTrue($sql == "SELECT * FROM `{$this::$table_name}`", $sql);
    }
}