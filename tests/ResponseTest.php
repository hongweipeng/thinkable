<?php
namespace tests;

use app\controller\Response;
use Psr\Http\Message\ResponseInterface;

class ResponseTest extends BaseTest {

    public $controller_uri = 'index.php/response/';

    public function test_response_text() {
        $client = $this->new_client();
        $response = $client->get($this->controller_uri . 'response_text');
        $this->verify_default_text($response);

        $response = $client->get($this->controller_uri . 'response_response');
        $this->verify_default_text($response);

        $response = $client->get($this->controller_uri . 'fast_response');
        $this->verify_default_text($response);
    }

    public function test_response_redirect() {
        $client = $this->new_client();
        $response = $client->get($this->controller_uri . 'response_redirect', ['allow_redirects' => false]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertNotEmpty($response->getHeader('Location'));
    }

    public function test_response_json() {
        $client = $this->new_client();
        $response = $client->get($this->controller_uri . 'response_json');
        $this->assertStringContainsString('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertNotNull(\json_decode((string) $response->getBody(), true));
    }

    public function verify_default_text(ResponseInterface $response) {
        $text = Response::$TEXT;
        $this->assertEquals($text, (string) $response->getBody());
    }
}
