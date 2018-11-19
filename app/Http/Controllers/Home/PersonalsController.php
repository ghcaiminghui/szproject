<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;

class PersonalsController extends Controller
{
    //个人中心的欢迎页
    public function index ()
    {

    	$username = \Cookie::get('username');

    	//加载视图
    	return view("home.personalCenter.index",compact('username'));
    }

    //个人中心的基本信息
    public function info()
    {

    	$info = Member::where('phone',\Cookie::get('username'))->first();

        $username = \Cookie::get('username');

    	//加载视图
    	return view("home.personalCenter.info",compact('info','username'));
    }

    //个人基本信息执行修改
    public function infoupdate(Request $request)
    {

    	//基本信息
    	$data = $request->only(['username','email','sex','birthday','phone']);

    	//更新信息
    	if( Member::where('phone',$data['phone'])->update($data) )
    	{
    		//返回成功信息
    		return response()->json(['msg'=>'1']);
    	}
    }

    //头像上传
    public function picload(Request $request)
    {
    	var_dump($request->all());
    	//判断是否有文件上传
    	if($request->hasFile('avatar_file') && $request->input('phone'))
    	{
    		//初始化名字
    		$name = $request->input('phone').rand(1,1000);

    		//获取上传文件后缀
    		$ext=$request->file("avatar_file")->getClientOriginalExtension();

    		//移动到指定目录
    		$request->file("avatar_file")->move("./uploads/".$request->input('phone'),$name.".".$ext);

    		return response()->json(['msg'=>'1']);
    	}

    }

}
