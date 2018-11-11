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
        // if(DB::table('manager')->where('role_id','!=','1')->value('role_id'))
        // {
        //     echo 1;
        // }

        return $next($request);
    }
}
