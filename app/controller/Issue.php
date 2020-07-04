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

    public function test_issue14553() {
        $expected = '/faker_controller/1.html'; // need by set: Route::any('faker_controller/:id','index/blog/read');

        // 当前域名
        $url = url('index/blog/read', ['id' => 1])->domain(true)->build();
        assertTrue(strpos($url, $_SERVER['HTTP_HOST']) && strpos($url, $expected), $url);

        //  子域名
        $url = url('index/blog/read', ['id' => 1])->domain('sub_domain')->build();
        assertTrue(
            strpos($url, sprintf('/%s.%s/', 'sub_domain', $_SERVER['HTTP_HOST']))
            && strpos($url, $expected), $url);

        // 其他域名生成
        $test_domains = [
            '127.0.0.1',
            '192.168.3.40',
            'local.local',
            'local.local.local',
            'comdev.com',
            'www.comdev.com',
            'com.local.com',
        ];
        foreach ($test_domains as $domain) {
            $url = url('index/blog/read', ['id' => 1])->domain($domain)->build();
            assertTrue(
                strpos($url, "/{$domain}/")
                && strpos($url, $expected), $url);
        }
    }


}