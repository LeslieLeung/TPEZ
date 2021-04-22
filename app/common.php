<?php
// 应用公共文件
/**
 * 获取指定位数的随机字符串
 * @return string str
 */
function getRandChars($length)
{
    $str = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen($strPol) - 1;

    //从中间抽出字符串加length次
    for ($i = 0; $i < $length; $i++){
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}

/**
 * 获取key
 * @return string
 */
function getKey()
{
    //用三组字符串md5加密
    //32个字符组成一组随机字符串
    $randChars = getRandChars(32);
    //时间戳
    $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
    //salt 盐
    $salt = config('setting.salt');

    $key = md5($randChars.$timestamp.$salt);

    return $key;
}