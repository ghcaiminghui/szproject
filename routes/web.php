<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//后台登录和退出
Route::resource("/adminlogin","Admin\AdminLoginController");

//后台路由组
Route::group(['middleware' => ['login','checkrbac'] ],function(){

	//管理后台首页的路由
	Route::resource("/admins","Admin\AdminsController");

	//后台管理员的路由
	Route::resource("/adminuser","Admin\AdminuserController");

	//权限管理资源控制器
	Route::resource("/auths","Admin\AuthsController");

	//角色的管理控制器
	Route::resource("/roles","Admin\RoleController");

	//会员管理资源控制器
	Route::resource("/members","Admin\MembersController");

	//商品资源控制器
	Route::resource("/goods","Admin\GoodsController");

	//无限分类资源控制器
	Route::resource("/cates","Admin\CatesController");

	//公告资源控制器
	Route::resource("/advert","Admin\AdvertController");

});

//前台登录
Route::get("/login","Home\LoginController@index");

//前台验证手机和发送短信的路由
Route::get("/login/match/phone","Home\LoginController@matchphone");	//检测手机
Route::get("/login/match/message","Home\LoginController@matchmessage");	//检测验证码
Route::get("/login/match/sendmessage","Home\LoginController@sendmessage"); //发送短信
Route::post("/login/create/store","Home\LoginController@store"); //执行添加注册
Route::post("/login/match/login","Home\LoginController@matchlogin"); //执行登录
Route::get("/login/logout","Home\LoginController@logout"); //退出登录

//前台路由
Route::group([],function(){

	//管理前台首页的路由
	Route::resource("/","Home\HomeController");

});



