<?php
namespace tests;


/**
 * 访问默认的首页
 * Class IndexTest
 * @package tests
 */
class IndexTest extends BaseTest {

    public function test_index() {
        $client = $this->new_client();
        $this->verify_response($client->get(''));
        $this->verify_response($client->get('index.php'));
        $this->verify_response($client->get('index.php/index'));
        $this->verify_response($client->get('index.php/index/index'));
    }

    public function test_404() {
        $client = $this->new_client();

        // 不存在的php文件
        $response = $client->get('no_exist_index.php', ['http_errors' => false]);
        $this->assertEquals(404, $response->getStatusCode());

        // 不存在的控制器
        $response = $client->get('index.php/no_exist_controller/index', ['http_errors' => false]);
        $this->assertEquals(404, $response->getStatusCode());

        // 不存在的方法
        $response = $client->get('index.php/index/no_exist_method', ['http_errors' => false]);
        $this->assertEquals(404, $response->getStatusCode());
    }
}
