<?php
namespace tests;

use app\controller\Issue;
use GuzzleHttp\Client;
use think\App;

class IssueTest extends BaseTest
{

    public function test_issue() {
        $controller = new Issue(new App());
        $this->run_controller_unit($controller, $this);
    }

    public function ext_config_test_issue2050(Client $client, array &$options) {
        $ext_config = [
            'route' => [ 'url_common_param'  => false]
        ];
        $options['headers']['think-config'] = json_encode($ext_config);

    }
}