<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

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
        //dd($request->cookie('message'));
        return view("home.index.login");
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
        //有信息代表是验证短息
        
        $message = $request->input('message');

        if(isset($_COOKIE['message']) && !empty($message)){

            if($request->cookie('message') == $message){

                return response()->json(['msg'=>'1']);
            }else{

               return response()->json(['msg'=>'0']);
            }
        }
     
    }

    public function store ()
    {

        echo 1;
    }
}
