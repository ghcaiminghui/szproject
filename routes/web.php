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

//后台路由组
Route::group([],function(){

	//主页资源控制器
	Route::resource("/admin","Admin\AdminController");

	//权限管理资源控制器
	Route::resource("/auths","Admin\AuthsController");

	//会员管理资源控制器
	Route::resource("/members","Admin\MembersController");

	//商品资源控制器
	Route::resource("/goods","Admin\GoodsController");

	//无限分类资源控制器
	Route::resource("/cates","Admin\CatesController");

});

//Route::resource("/admin","Admin\AdminController");

