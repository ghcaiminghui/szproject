<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //加载后台登录模板
        return view("admin.login.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载登录模板
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取登录名和密码
        $username=$request->input("username");
      
        $password=$request->input("password");
        
        //要数据表的数据对比
        //检测用户名
       $info=DB::table("manager")->where("username",'=',$username)->first();
       // dd($info);
         //判断密码
        if($info){
        	//把登录的用户名存储在session里
        	session(['username'=>$username,'role_id'=>$info->role_id]);
            //检测密码
            
            //哈希数据值检测
             // if(Hash::check($password,$info->password)){
              return redirect("/admins")->with('success','登录成功');

            // }else{
            //     return back()->with('error','登录失败');
            //  }
           
        }else{
           
           // echo "用户名错误";
            return back()->with('error','用户名有误');

        }
        

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
