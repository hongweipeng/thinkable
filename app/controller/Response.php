<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;

class Response extends BaseController {
    static $TEXT = 'hello';

    public function response_null() {
        return null;
    }

    public function response_text() {
        return static::$TEXT;
    }

    public function response_response() {
        return \think\Response::create(static::$TEXT);
    }

    // 快捷方式
    public function fast_response() {
        return response(static::$TEXT);
    }

    public function response_redirect() {
        return redirect('/');
    }

    public function response_json() {
        return json([
            'status' => 0,
            'msg' => static::$TEXT,
        ]);
    }

}
