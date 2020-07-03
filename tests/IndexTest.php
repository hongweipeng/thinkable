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

    public function test_hello() {
        $client = $this->new_client();
        $response = $client->get('index.php/index/hello', ['http_errors' => false]);
        // hello 因设置了路由，用常用的方式访问将是 404
        $this->assertEquals(404, $response->getStatusCode());

        /* 使用路由方式访问 */
        $response = $client->get('index.php/hello', ['http_errors' => false]); // 无参数访问，将得到404
        $this->assertEquals(404, $response->getStatusCode());

        $response = $client->get('index.php/hello/custom_name');   // 定义key
        $this->assertEquals('hello,custom_name', (string) $response->getBody());
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
