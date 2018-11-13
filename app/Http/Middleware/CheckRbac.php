<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Route;
use DB;

class CheckRbac
{
    /**
     * Rbac中间件
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        
        //判断是否是超级管理员
        if( session('role_id') != '1' )
        {
            //获取当前的路由
            $route = Route::currentRouteAction();
            
            //获取当前用户的相关权限
            $ac = DB::table('role')->where('id','=',session('role_id'))->value('auth_ac');
            $ac = $ac.',adminscontroller@index,adminscontroller@create';

            //获取当前路由的最后的控制器和方法名
            $routeArr = explode('\\', $route);
            
            //判断当前路由的控制器和方法是否存在于用户的权限表中
            if(strpos($ac,strtolower(end($routeArr))) === false)
            {
                exit("<h1>没有访问的权限<h1>");
 
            }
        }

        return $next($request);
    }
}
