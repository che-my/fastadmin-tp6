<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// [ 后台入口文件 ]
// 使用此文件可以达到隐藏admin模块的效果
// 建议将admin.php改成其它任意的文件名，同时修改config.php中的'deny_module_list',把admin模块也添加进去
namespace think;
define('DS', DIRECTORY_SEPARATOR);
// 定义根目录
define('ROOT_PATH', __DIR__ . DS.'..');
// 定义应用目录
define('APP_PATH', ROOT_PATH . DS.'app'.DS);

// 判断是否安装FastAdmin
if (!is_file(APP_PATH . 'admin'.DS.'command'.DS.'Install'.DS.'install.lock'))
{
    header("location:./install.php");
    exit;
}

require __DIR__ . '/../vendor/autoload.php';

// 绑定到admin模块
\think\facade\Route::bind('admin');

// 执行HTTP应用并响应
$http = (new  App())->make('http');

$response = $http->name('admin')->run();

$response->send();

$http->end($response);
