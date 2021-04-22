<?php
//------------------------------
// Author: Leslie Leung
// Email: lesily9@gmail.com
//------------------------------
namespace app\middleware;


use app\model\Token;
use think\facade\Request;

class Auth
{
    public function handle($request, \Closure $next)
    {
        $token = Request::header('Authorization');
        if ($credentials = Token::retrieveToken($token)) {
            $request->id = $credentials['id'];
            $request->role = $credentials['role'];
        } else {
            return json([
                'code' => JSON_AUTH_EXPIRED,
                'msg' => "token过期或无效，请重新登录！"
            ]);
        }
        return $next($request);
    }
}