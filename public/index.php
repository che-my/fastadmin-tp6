<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
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

// 执行HTTP应用并响应
$http = (new  App())->http;

$response = $http->run();

$response->send();

$http->end($response);



