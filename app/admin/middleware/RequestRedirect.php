<?php

/**
 * @Author: che-my
 * @Date:   2019-06-09 03:10:01
 * @Last Modified by:   che-my
 * @Last Modified time: 2019-06-09 03:35:09
 */
namespace app\admin\middleware;

/**
 * 记录日志后置行为的中间件
 */
class RequestRedirect
{
    public function handle($request, \Closure $next)
    {
    	
		$response = $next($request);

      

        return $response;
    }
}