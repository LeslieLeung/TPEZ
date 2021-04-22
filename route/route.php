<?php

use think\facade\Route;


// 无需token的接口
// no token apis
Route::rule('index/login', 'Index/login', 'POST')
    ->middleware(\app\middleware\CheckParam::class);

// 通用接口
// general apis
Route::rule('index/:name', 'Index/:name', 'POST')
    ->middleware([\app\middleware\CheckParam::class, \app\middleware\Auth::class]);

// 用户接口
Route::group('user', function() {
    // 这里添加用户的接口
    // add user apis here
    Route::rule('helloUser', 'User/helloUser', 'POST');
})->middleware([\app\middleware\CheckParam::class, \app\middleware\UserAuth::class]);

// 管理员接口
Route::group('admin', function() {
    // 这里添加管理员的接口
    // add admin apis here
    Route::rule('helloAdmin', 'Admin/helloAdmin', 'POST');
})->middleware([\app\middleware\CheckParam::class, \app\middleware\AdminAuth::class]);
