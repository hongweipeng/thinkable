<?php
namespace app\controller;

use app\BaseController;


/*
 * 检验 url 的生成
 */
class UrlBuild extends BaseController {

    // 生成首页的网址
    public function test_index() {
        $url = url('/')->build();
        assertTrue(substr_compare($url, '/', -strlen('/')) === 0, $url);    // 是否已 '/' 结尾

        $url = url('index/index')->build();
        assertTrue(strpos($url, sprintf('index/index.%s', config('view.view_suffix'))), $url);
    }

    public function test_domain() {
        $url = url('/', [], true, true)->build();
        $parser = parse_url($url);
        assertEquals($_SERVER['HTTP_HOST'], $parser['host'], $url);
    }

    // 带参数的 url 生成
    public function test_url_params() {
        $params = ['name' => 'Tom', 'age' => 18];
        $url = url('/', $params)->build();
        assertTrue(strpos($url, http_build_query($params)) !== false, $url);
    }

}
