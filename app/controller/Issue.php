<?php


namespace app\controller;


use app\BaseController;


class Issue extends BaseController
{

    public function test_issue2050() {
        $expected = '/index/test/name/tom';
        $url = url('index/test', ['name'=>'tom', 'desc'=>''])->build();
        assertTrue(strpos($url, $expected) !== false, $url);
        $url = url('index/test', ['name'=>'tom', 'desc'=>null]);
        assertTrue(strpos($url, $expected) !== false, $url);
        $url = url('index/test', ['name'=>'tom', 'desc'=>null]);
        assertTrue(strpos($url, $expected) !== false, $url);
    }

}