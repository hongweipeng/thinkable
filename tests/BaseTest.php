<?php
namespace tests;

use app\BaseController;
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
    public function verify_response(ResponseInterface $response, $message = null) {
        if ($message === null) {
            $message = (string) $response->getBody();
        }
        $this->assertEquals(200, $response->getStatusCode(), $message);
    }

    public function run_controller_unit(BaseController $controller) {
        $class = new \ReflectionClass($controller);
//        var_dump($class->inNamespace());
//        var_dump($class->getName());
//        var_dump($class->getNamespaceName());
//        var_dump($class->getShortName());
//        var_dump($class->getMethods());
        $controller_name = $class->getShortName();
        foreach ($class->getMethods() as $method) {
            // 方法名是否以 test 开头
            if (strpos($method->name, 'test') === 0) {
                $url = sprintf('index.php/%s/%s', $controller_name, strtolower($method->name));
                $response = $this->new_client()->get($url, ['http_errors' => false]);
                $this->verify_response($response, "{$controller_name}->{$method->name}:{$response->getBody()}");
            }
        }

    }

    public function test_true() {
        $this->assertEquals(true, true);
    }

}


