<?php
// 应用公共文件

function assertTrue($cond, string $message = '') {
    if (!$cond) {
        $response = response($message, 500);
        throw new \think\exception\HttpResponseException($response);
    }
}

function assertEquals($expected, $actual, string $message = '') {
    assertTrue($expected == $actual, $message);
}
