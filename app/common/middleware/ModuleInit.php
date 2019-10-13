<?php

/**
 * @Author: che-my
 * @Date:   2019-06-09 01:39:44
 * @Last Modified by:   che-my
 * @Last Modified time: 2019-10-13 20:15:09
 */
namespace app\common\middleware;

use think\facade\Config;
use think\facade\Cookie;

class ModuleInit
{
	public function handle($request, \Closure $next)
    {
         // 设置mbstring字符编码
        mb_internal_encoding("UTF-8");

        // 如果修改了index.php入口地址，则需要手动修改cdnurl的值
        $url = preg_replace("/\/(\w+)\.php$/i", '', '');

        $view = array();

        // 如果未设置__CDN__则自动匹配得出
        $templateConfig = Config::get('view.tpl_replace_string');

        if (!$templateConfig['__CDN__']) {
        	$view['tpl_replace_string']['__CDN__'] = $url;
        }

        // 如果未设置__PUBLIC__则自动匹配得出
        if (!$templateConfig['__PUBLIC__']) {
        	$view['tpl_replace_string']['__PUBLIC__'] = $url. '/';
        }
        // 如果未设置__ROOT__则自动匹配得出
        if (!$templateConfig['__ROOT__']) {
            $view['tpl_replace_string']['__ROOT__'] = preg_replace("/\/public\/$/", '', $url . '/');
        }
        
        if(count($view)){
        	Config::set($view,'view');
        }
        // 如果未设置cdnurl则自动匹配得出
        if (!Config::get('site.cdnurl')) {
            Config::set(['cdnurl'=>$url],'site');
        }
        // 如果未设置cdnurl则自动匹配得出
        if (!Config::get('upload.cdnurl')) {
            Config::set(['cdnurl'=>$url],'upload');
        }
        if (env('app_debug')) {
            // 如果是调试模式将version置为当前的时间戳可避免缓存
            Config::set(['version'=>time()],'site');
            // 如果是开发模式那么将异常模板修改成官方的
            Config::set(['exception_tmpl'=>app()->getThinkPath() . 'tpl/think_exception.tpl'],'app');
        }
        // 如果是trace模式且Ajax的情况下关闭trace
        if (env('app_trace') && $request->isAjax()) {
            env('app_trace',false);
        }

        // 切换多语言
        if (Config::get('lang.switch_group') && $request->get('lang')) {
            Cookie::set('think_var', $request->get('lang'));
        }

        // Form别名
        if (!class_exists('Form')) {
            class_alias('fast\\Form', 'Form');
        }

        return $next($request);
    }
}
