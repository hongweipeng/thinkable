<?php
namespace app\middleware;


use app\Request;
use think\facade\Config;


/**
 * 从请求的 header 中 think-config 中获取配置，做动态修改
 * Class ConfigMiddleware
 * @package app\middleware
 */
class ConfigMiddleware
{
    static $HEADER_KEY = 'think-config';
    public function handle(Request $request, \Closure $next) {
        $header_line = $request->header(static::$HEADER_KEY);
        if ($header_line) {
            $custom_config = \json_decode($header_line, true);
            foreach ($custom_config as $namespace => $config) {
                Config::set($config, $namespace);
            }
        }
        //\think\facade\Config::set(['url_common_param' => false], 'route');
        return $next($request);
    }
}