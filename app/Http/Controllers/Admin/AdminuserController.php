<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Adminuser;
use DB;
use Hash;

class AdminuserController extends Controller
{
    /**
     * 这个控制器是后台管理员
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$data = DB::table('manager as m')->join('role as r','m.role_id','=','r.id')->select('m.*','r.*')->get();
        $data = Adminuser::get();
        
        return view("admin.adminuser.index",compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = DB::table('role')->select('id','role_name')->get();
       
        return view("admin.adminuser.add",compact('data'));
        
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token','password2');
        $data['status'] = 2; //账号状态默认开启
        $data['password'] = Hash::make($data['password']);
        if(Adminuser::create($data)){

            return response()->json(['msg'=>1]);
        }else{

            return response()->json(['msg'=>0]);
        }
    }   

    /**
     * ajax删除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(DB::table('manager')->where('id',$id)->delete())
        {
            return response()->json(['msg'=>1]);
        }else{

            return response()->json(['msg'=>0]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //接收值
        $msg = $request->input('msg');
        //1==停用，2==启用 ,返回0==失败 
        if( $msg == 1 || $msg == 2)
        {
            if(DB::table('manager')->where('id',$id)->update(['status' => $msg]))
            {
                return response()->json(['msg'=>1]);
            }else{
                return response()->json(['msg'=>0]);
            }
        }else{
            return response()->json(['msg'=>0]);
        }
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
