<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Member;
use Hash;

class LoginController extends Controller
{
    /**
     * 加载登录和注册的视图 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  

        $data = $request->cookie('message');
        
        return view("home.index.login",['data'=>$data]);
    }

    /**
     * 前台注册手机验证
     *
     * @param  int  $id
     * @return msg=0手机号可以使用|msg=1手机号已被注册
     */
    public function matchphone(Request $request)
    {
        //接收手机值
        $phone = $request->input('phone');
        
        //查询有没有
        $data = DB::table('member')->where('phone',$phone)->first();

        if($data != null)
        {
            return response()->json(['msg'=>'1']);
        }else{

            return response()->json(['msg'=>'0']);
        }


    }

    /**
     * 注册发送短息
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendmessage(Request $request)
    {

        $phone = $request->input('phone');

        sendphone($phone);
                
    }

    /**
     * 注册验证短信的信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function matchmessage(Request $request)
    {
        
        $message = $request->input('message');

        if(isset($_COOKIE['message']) && !empty($message)){

            if($request->cookie('message') == $message){

                return response()->json(['msg'=>'1']);
            }
        }
     
    }

    /**
     * 注册执行添加信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {

        $data = $request->only(['phone','password']);
        $data['token'] = str_random(50);
        $data['type'] = 1;
        $data['status'] = 1;
        $data['password'] = Hash::make($data['password']);
        $data['username'] = $data['phone'];
        //var_dump($data);
        if(Member::create($data)){

            session(['username'=>$data['username']]);

            return response()->json(['msg'=>'1']);
        }else{

             return response()->json(['msg'=>'0']);
        }
    }

    /**
     * 登录检查
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function matchlogin(Request $request)
    {

        $phone = $request->input('phone');
        $password = $request->input('password');

        if($info = Member::where('phone','=',$phone)->first()){

            if(Hash::check($password,$info->password)){

                \Cookie::queue('username',$info->phone,120);

                return response()->json(['msg'=>'1']);
            }else{

                return response()->json(['msg'=>'0']);
            }

        }else{
            //你输入的密码和账户名不匹配
            return response()->json(['msg'=>'0']);
        }
    }

     /**
     * 退出登录
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout ()
    {
        //清除cookie
        \Cookie::queue(\Cookie::forget('username'));

        return redirect("/");
    }
}
