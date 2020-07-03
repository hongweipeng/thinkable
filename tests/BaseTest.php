<?php
namespace tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

class BaseTest extends TestCase {
    static $BASE_URL = 'http://localhost/thinkable/public/';

    public function new_client() {
        $client = new Client([
            'base_uri' => static::$BASE_URL,
        ]);
        return $client;
    }

    /**
     * 简单验证返回体
     * 状态码是否为 200
     * @param ResponseInterface $response
     */
    public function verify_response(ResponseInterface $response) {
        $this->assertEquals(200, $response->getStatusCode(), (string) $response->getBody());
    }

    public function test_true() {
        $this->assertEquals(true, true);
    }

}


