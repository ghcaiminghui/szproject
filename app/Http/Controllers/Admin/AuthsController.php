<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AuthsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table('auth')->select('auth.*','a.auth_name as parentname')->leftJoin('auth as a','auth.pid','=','a.id')->get();
        
        return view("admin.auths.index",['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加权限的视图和相关数据
        $data = DB::table('auth')->where('pid','=','0')->get();

        return view("admin.auths.add",['data'=>$data]);
    }

    /**
     * 执行添加权限的操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收提交过来的数据
        if($request->isMethod('post'))
        {

            $data = $request->except('_token');
            //var_dump($data);
            if(DB::table('auth')->insert($data)){

                echo 1;
            }else{

                echo 2;
            }

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
        if(DB::table('auth')->where('id',$id)->delete())
        {
            return response()->json(['msg'=>'1']);
        }
    }

    /**
     * 修改权限节点
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询所有的顶级权限
        $data = DB::table('auth')->where('pid','=','0')->get();
        //$data = DB::table('auth')->where('auth.pid','=','0')->select('auth.*','a.auth_name as parentname')->leftJoin('auth as a','auth.pid','=','a.id')->get();
        $info = DB::table('auth')->where('id',$id)->first();
        $pid = DB::table('auth')->where('id','=',$info->pid)->first();

        return view("admin.auths.edit",['data'=>$data,'info'=>$info,'pid'=>$pid]);
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
        $data = $request->except('_token','_method');

        if(DB::table('auth')->where('id',$id)->update($data))
        {
            return response()->json(['msg'=>'1']);
        }

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
