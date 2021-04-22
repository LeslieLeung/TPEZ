<?php
//------------------------------
// Author: Leslie Leung
// Email: lesily9@gmail.com
//------------------------------

namespace app\model;


class Token
{
    public function grantToken(int $id, int $role, $info=null): string
    {
        $key = getKey();
        $credentials = [
            'id' => $id,
            'role' => $role,
            'info' => $info
        ];

        $expireTime = env('token.expire_time');
        cache($key, $credentials, $expireTime);
        return $key;
    }

    public function destroyToken(string $token): int
    {
        cache($token, null);
        return 0;
    }

    public static function retrieveToken(string $token): ?array
    {
        // token默认以"Bearer "开头，通过substr去掉
        $credentials = cache(substr($token, 7));
        if (!$credentials) {
            return null;
        }
        return $credentials;
    }
}