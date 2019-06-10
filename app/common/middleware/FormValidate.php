<?php
/**
 * @Author: che-my
 * @Date:   2019-06-09 01:39:44
 * @Last Modified by:   che-my
 * @Last Modified time: 2019-06-10 13:45:55
 */
namespace app\common\middleware;

class FormValidate
{
    /**
     * @param \think\Request $request
     * @param \Closure $next
     * @return mixed|\think\response\Json
     */
    public function handle($request, \Closure $next)
    {
    	$response = $next($request);
        //获取当前参数
        $params = $request->param();
        if(count($params)){
            foreach ($params as $key => $value) {
                $params[$key] = htmlspecialchars_decode(trim($value));
            } 
        }
        //获取当前应用
        $module = $request->app();
        //获取访问控制器
        $controller = strtolower($request->controller());
        if(strpos($controller,'.')!== false){
        	$controller = explode('.',$controller);
        	$controller = ucfirst($controller[0]).ucfirst($controller[1]);
        }else{
        	$controller = ucfirst($controller);
        }
        //获取操作名,用于验证场景scene
        $scene = $request->action();
        $validate = "app\\".$module."\\validate\\" . $controller;
        //仅当验证器存在时 进行校验
        if (class_exists($validate)) {
            $v = new $validate;
            //仅当存在验证场景才校验
            if ($v->hasScene($scene)) {
                //设置当前验证场景
                $v->scene($scene);
                if (!$v->check($params)) {
                    //校验不通过则直接返回错误信息
                    return $v->getError();
                }
            }
        }
        return $response;
    }
}