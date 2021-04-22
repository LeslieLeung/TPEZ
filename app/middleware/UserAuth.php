<?php


namespace app\middleware;


class UserAuth extends Auth
{
    public function handle($request, \Closure $next)
    {
        parent::handle($request, $next);
        if ($request->role != ROLE_USER) {
            return json([
                'code' => JSON_NOT_AUTHED,
                'msg' => "权限错误"
            ]);
        } else {
            return $next($request);
        }
    }
}