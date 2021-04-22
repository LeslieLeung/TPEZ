<?php


namespace app\middleware;

use think\facade\Request;
class CheckParam
{
    public function handle($request, \Closure $next)
    {
        // 检验是否有传入参数
        if (empty(Request::header("Authorization"))) {
            return json([
                'code' => JSON_PARAM_MISSING,
                'msg' => "缺少token参数，禁止访问！"
            ]);
        }

        // 处理data参数
        $request->data = input("post.data");
        return $next($request);
    }
}