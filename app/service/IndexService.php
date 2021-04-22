<?php


namespace app\service;


use app\model\Token;

class IndexService
{
    public function login(string $username, string $password)
    {
        if ($username == "admin" && $password == 'admin') {
            return (new Token())->grantToken(1, ROLE_ADMIN);
        } elseif ($username == 'user' && $password == 'user') {
            return (new Token())->grantToken(2, ROLE_USER);
        } else {
            return -1;
        }
    }
}