<?php

namespace think\addons\addons;

use think\facade\Config;
use think\exception\HttpException;
use think\facade\Event;
use think\facade\App;
use think\facade\Request;

/**
 * 插件执行默认控制器
 * @package think\addons
 */
class Route
{

    /**
     * 插件执行
     */
    public function execute($addon = null, $controller = null, $action = null)
    {
        $request = Request::instance();
        // 是否自动转换控制器和操作名
        $convert = Config::get('app.url_convert');
        $filter = $convert ? 'strtolower' : 'trim';

        $addon = $addon ? trim(call_user_func($filter, $addon)) : '';
        $controller = $controller ? trim(call_user_func($filter, $controller)) : 'index';
        $action = $action ? trim(call_user_func($filter, $action)) : 'index';

        Event::listen('addon_begin', function($request){
            // 加载插件语言包
            $langset = cookie('think_var')?cookie('think_var'):\think\facade\Lang::getLangSet();
            \think\facade\Lang::load([
                APP_PATH . 'common' . DS . 'lang' . DS . $langset . DS . 'addon' . EXT,
            ]);
        });
        if (!empty($addon) && !empty($controller) && !empty($action)) {
            $info = get_addon_info($addon);
            if (!$info) {
                throw new HttpException(404, __('addon %s not found', $addon));
            }
            if (!$info['state']) {
                throw new HttpException(500, __('addon %s is disabled', $addon));
            }
            $dispatch = $request->dispatch();

//            if (isset($dispatch['var']) && $dispatch['var']) {
//                //$request->route($dispatch['var']);
//            }


            // 设置当前请求的控制器、操作
            $request->controller($controller);
            $request ->action($action);

            // 监听addon_module_init
            Event::listen('addon_module_init', $request);
            // 兼容旧版本行为,即将移除,不建议使用
            Event::listen('addons_init', $request);

            $class = get_addon_class($addon, 'controller', $controller);
            if (!$class) {
                throw new HttpException(404, __('addon controller %s not found', App::parseName($controller, 1)));
            }
            //p($class);die;
            $instance = new $class($request);

            $vars = [];
            if (is_callable([$instance, $action])) {
                // 执行操作方法
                $call = [$instance, $action];
            } elseif (is_callable([$instance, '_empty'])) {
                // 空操作
                $call = [$instance, '_empty'];
                $vars = [$action];
            } else {
                // 操作不存在
                throw new HttpException(404, __('addon action %s not found', get_class($instance) . '->' . $action . '()'));
            }

            Event::listen('addon_action_begin', $call);

            return call_user_func_array($call, $vars);
        } else {
            abort(500, lang('addon can not be empty'));
        }
    }

}
