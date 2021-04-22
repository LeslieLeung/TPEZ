<?php


namespace app\middleware;


class AdminAuth extends Auth
{
    public function handle($request, \Closure $next)
    {
        parent::handle($request, $next);
        if ($request->role != ROLE_ADMIN) {
            return json([
                'code' => JSON_NOT_AUTHED,
                'msg' => "权限错误"
            ]);
        } else {
            return $next($request);
        }
    }
}