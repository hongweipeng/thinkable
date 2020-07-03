<?php
namespace tests;


use app\controller\UrlBuild;
use think\App;

/**
 * 检验一些在控制器中 test_* 的方法，默认仅检验响应response的状态码是否为 200
 * Class SimpleControllerTest
 * @package tests
 */
class SimpleControllerTest extends BaseTest {

    public function test_url() {
        $controller = new UrlBuild(new App());
        $this->run_controller_unit($controller);
    }
}