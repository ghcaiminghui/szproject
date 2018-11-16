<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LoginController extends Controller
{
    /**
     * 前台登录
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //$param = substr(strval(rand(10000,19999)),1,4);
        //\Cookie::queue('message',$param,'3');
        //dd($request->cookie('message'));
        return view("home.index.login");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //前台注册手机验证
    public function matchphone(Request $request)
    {
        //接收手机值
        $phone = $request->input('phone');

        //查询有没有
        $data = DB::table('member')->where('phone',$phone)->first();

        //判断结果，0=手机号可以使用，1=手机已被注册
        if($data != null)
        {
            return response()->json(['msg'=>'1']);
        }else{

            return response()->json(['msg'=>'0']);
        }
    }

    //注册发送短息，和验证短息
    public function matchmessage(Request $request)
    {
        if($request->has('phone')){

            $phone = $request->input('phone');

            sendphone($phone);
        }
        //有信息代表是验证短息
        if($request->has('message')){

            $message = $request->input('message');

            if(isset($_COOKIE['message']) && !empty($message)){

                if($request->cookie('message') == $message){

                    echo '1';
                }else{

                    echo '2';
                }
            }
        }
        
    }
}
