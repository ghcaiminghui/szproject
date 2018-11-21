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

	//商品资源控制器
	Route::post("/goods/create","Admin\GoodsController@create");
	Route::resource("/goods","Admin\GoodsController");

	
	//图片上传到七牛服务器
    Route::post('/uploader/qiniu','Admin\UploaderController@qiniu');
	//异步头像上传地址
    Route::post('/uploader/webuploader','Admin\UploaderController@webuploader');
    

	//订单资源控制器
	Route::post('/order/create',"Admin\OrderController@create");
	Route::get("/order/getareabyid","Admin\OrderController@getAreaById");
	Route::resource("/order","Admin\OrderController");

});

//前台登录
Route::get("/login","Home\LoginsController@index"); 
//退出登录
Route::get("/login/logout","Home\LoginsController@logout");
//登录检查账号和密码
Route::post("/login/match/login","Home\LoginsController@matchlogin"); 
//发送短信
Route::get("/login/match/sendmessage","Home\LoginsController@sendmessage"); 
//注册路由负责检查手机号和验证码是否存在，最后添加信息
Route::post("/login/match/registered","Home\LoginsController@registered");	
//重置密码
Route::post("/login/match/reset","Home\LoginsController@reset");

//商品详情列表
Route::resource("/info","Home\InfoController"); 	
//购物车
Route::resource("/cart","Home\CartController");  


//管理前台首页的路由
Route::resource("/","Home\HomeController");


//前台路由
Route::group(['middleware'=>'homelogin'],function(){

	//个人中心欢迎页路由
	Route::get("/personal","Home\PersonalsController@index");
	//个人中心(个人详情)
	Route::get("/personal/info","Home\PersonalsController@info");
	//个人详情执行修改
	Route::post("/personal/infoupdate","Home\PersonalsController@infoupdate");
	//个人中心(头像上传)
	Route::post("/personal/picload","Home\PersonalsController@picload");
	//个人中心(加载修改密码页面)
	Route::get("/personal/repwd","Home\PersonalsController@repwd");
	//个人中心(检测原密码)
	Route::post("/personal/matchpwd","Home\PersonalsController@matchpwd");
	//个人中心（重设密码）
	Route::post("/personal/resetpwd","Home\PersonalsController@resetpwd");
	//个人中心(个人的收获地址)
	Route::resource("/personal/address","Home\AddressController");


});


