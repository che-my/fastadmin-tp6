<?php
namespace app\admin\middleware;

/**
 * 记录日志后置行为的中间件
 */
class AdminLog
{
    public function handle($request, \Closure $next)
    {
    	$response = $next($request);

        if ($request->isPost()) {
            \app\admin\model\AdminLog::record();
        }

        return $response;
    }
}
