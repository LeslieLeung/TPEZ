TPEZ 基于ThinkPHP6.0再封装的框架
====

## 简介
TPEZ（读作tp easy）是一个基于ThinkPHP6.0.x再封装的框架，旨在帮助新手更快上手ThinkPHP框架，同时方便老手快速基于本框架进行项目开发。TPEZ凝聚作者三年PHP项目开发经验，对一些项目共性的功能（如JSON返回、权限管理、controller-service-model结构等）进行封装，方便后端同学使用TPEZ作为脚手架进行后续开发。同时，提供了登录、用户端、管理端模拟等示例接口，供前端同学学习。

## 特性
- 对控制器返回Json进行了封装
- 实现了权限管理机制（使用中间件）
- 实现了token封装
- 扩充了基本框架（增加service层，将业务逻辑与模型和控制器分开）
- 增加了若干范例（包括controller、service、route、env等的使用）
- 提供了可用的示例接口供前端学习
- 与官方ThinkPHP6.0.x完全兼容，若后续官方版本更新，可以方便升级

## 使用

### 快速上手

从Release下载后解压，上传至服务器。上传后目录结构应如图所示（我的网站目录为/data/www/tpez.ameow.xyz）：

![](https://ameow-1255787947.cos.ap-guangzhou.myqcloud.com/img/20210422151013.png)

同时，需要将DocumentRoot（网站根目录）修改为public。

（apache示例，注意第7行修改了DocumentRoot）

```
<VirtualHost *:87>
    ServerAdmin ***
    php_admin_value open_basedir /data/www/tpez.ameow.xyz:/tmp:/var/tmp:/proc
    ServerName tpez.ameow.xyz
    ServerAlias tpez.ameow.xyz
    DocumentRoot /data/www/tpez.ameow.xyz/public
    <Directory /data/www/tpez.ameow.xyz>
        SetOutputFilter DEFLATE
        Options FollowSymLinks
        AllowOverride All
        Order Deny,Allow
        Require all granted
        DirectoryIndex index.php index.html index.htm
    </Directory>
    ErrorLog /data/wwwlog/tpez.ameow.xyz/error.log
    CustomLog /data/wwwlog/tpez.ameow.xyz/access.log combined
</VirtualHost>
```

### 升级

本项目与ThinkPHP6.0.x兼容，若需要更新框架使用

```
composer update topthink/framework
```

## 项目结构

对官方框架进行再封装的部分在旁边以*注明。

```
www  WEB部署目录（或者子目录）
├─app           应用目录
│  ├─controller      控制器目录*（封装ResponseController，增加示例）
│  ├─model           模型目录
│  ├─middleware      中间件目录*（封装参数检查和权限管理中间件）
│  ├─service         逻辑层目录*（增加示例）
│  ├─enum.php        常用常量*（状态码、权限角色等）
│  ├─ ...            更多类库目录
│  │
│  ├─common.php         公共函数文件* （增加toekn相关函数）
│  └─event.php          事件定义文件
│
├─config                配置目录
│  ├─app.php            应用配置
│  ├─cache.php          缓存配置
│  ├─console.php        控制台配置
│  ├─cookie.php         Cookie配置
│  ├─database.php       数据库配置
│  ├─filesystem.php     文件磁盘配置
│  ├─lang.php           多语言配置
│  ├─log.php            日志配置
│  ├─middleware.php     中间件配置
│  ├─route.php          URL和路由配置* （修改为强制路由，配合权限管理使用）
│  ├─session.php        Session配置
│  ├─trace.php          Trace配置
│  └─view.php           视图配置
│
├─view            视图目录
├─route                 路由定义目录
│  ├─route.php          路由定义文件
│  └─ ...   
│
├─public                WEB目录（对外访问目录）
│  ├─index.php          入口文件* （引入enum常量）
│  ├─router.php         快速测试文件
│  └─.htaccess          用于apache的重写
│
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                Composer类库目录
├─.env                  环境变量文件* （提供部分配置）
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─think                 命令行入口文件
 
```

## 示例接口
### 接口规范
如无特殊说明，请求方式统一使用`POST`。
baseurl：http://tpez.ameow.xyz

token应放在Headers中，如

```
Authorization: Bearer xxxxxx (注意【Bearer 】不要漏掉)
```

#### 请求格式
```json
{
  "data": {
    "key1": "value1",
    "key2": "value2",
    ... // other params
  }
}
```
#### 返回格式
```json
{
  "code": "xxxxx",
  "msg": "xxxxx",
  "data": {
    "key1": "value1",
    ... // other infos
  }
}
```
说明：code为5位含字母和数字的字符串，具体定义参见阿里Java开发手册中关于错误码的定义和`app/enums.php`中的定义。msg为根据业务场景的信息提示。
### 登录接口
***需要先登录才能进行后面的步骤***

```json
请求地址：http://tpez.ameow.xyz/index/login
Headers:
	Authorization: Bearer login
Request:
{
    "data": {
        "username": "user", // admin端用户名为admin
       	"password": "user"  // admin端密码为admin
    }
}
Response:
{
    "code": "00000",
    "msg": "请求成功",
    "data": {
        "token": "9dd50f96312c18fed0b5e70e2f595e8a"
    }
}
{
    "code": "A0200",
    "msg": "用户名或密码错误"
}
```

### 模拟用户端接口

```json
请求地址：http://tpez.ameow.xyz/user/helloUser
Headers:
	Authorization: Bearer 9dd50f96312c18fed0b5e70e2f595e8a
Request:
{
}
Response:
{
    "code": "00000",
    "msg": "Hello user!"
}
若使用admin或其他不合法token：
{
    "code": "A0301",
    "msg": "权限错误"
}
```

### 模拟管理端接口

```json
请求地址：http://tpez.ameow.xyz/admin/helloAdmin
Headers:
	Authorization: Bearer 9dd50f96312c18fed0b5e70e2f595e8a
Request:
{
}
Response:
{
    "code": "00000",
    "msg": "Hello admin!"
}
若使用user或其他不合法token：
{
    "code": "A0301",
    "msg": "权限错误"
}
```

## 版权信息

本项目基于ThinkPHP再开发，遵循Apache2开源协议发布，并提供免费使用。

ThinkPHP遵循Apache2开源协议发布，并提供免费使用。

本项目包含的第三方源码和二进制文件之版权信息另行标注。

版权所有Copyright © 2006-2020 by ThinkPHP (http://thinkphp.cn)

All rights reserved。

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

更多细节参阅 [LICENSE.txt](LICENSE.txt)

## 致谢

感谢[Quanta（量子）信息技术服务中心](http://www.quantacenter.com)和塔里师兄师姐在这几年成长中给我提供的机会和帮助！感谢塔里一起开发的小伙伴！感谢这几年遇到的不胜枚举但又给我莫大帮助的各位！