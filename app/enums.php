<?php
//------------------------------
// Author: Leslie Leung
// Email: lesily9@gmail.com
//------------------------------

// enum

// 状态码enum
// 该部分参考阿里开发手册（嵩山版）错误码设计
const JSON_SUCCESS = "00000"; // 成功状态

const JSON_USER_ERROR = "A0001"; // 用户一级宏观错误码
const JSON_USER_ALREADY_EXIST = "A0111"; // 用户名已存在
const JSON_LOGIN_ERROR = "A0200"; // 登录异常
const JSON_USER_NOT_EXIST = "A0201"; // 用户不存在
const JSON_WRONG_PASSWORD = "A0210"; // 用户密码错误
const JSON_AUTH_ERROR = "A0300"; // 访问权限异常
const JSON_NOT_AUTHED = "A0301"; // 访问未授权
const JSON_AUTH_EXPIRED = "A0311"; // 授权已过期
const JSON_NO_AUTH = "A0312"; // 无权限
const JSON_PARAM_ERROR = "A0400"; // 用户请求参数错误
const JSON_PARAM_MISSING = "A0410"; // 请求必填参数为空

const JSON_SERVER_ERROR = "B0001"; // 系统一级宏观错误码


// 角色enum
const ROLE_SUPER = 1;
const ROLE_ADMIN = 2;
const ROLE_USER = 3;

