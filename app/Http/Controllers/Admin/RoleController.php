<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use DB;

class RoleController extends Controller
{
    /**
     * 这是权限控制器.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //权限的显示
        $data = Role::get();
        //查询用户列表
        $adminuser = DB::table('manager')->get();
        //查询记录数
        $num = DB::table('role')->count();
        //加载视图
        return view("admin.role.index",compact('data','adminuser','num'));
    }

    /**
     * 这是添加角色
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //加载添加页面
        return view("admin.role.add");
    }

    /**
     * 处理执行添加分派权限的操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->only('role_name');
        
        if(DB::table('role')->insert($data))
        {
            return response()->json(['msg'=>'1']);
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
        if(DB::table('role')->where('id',$id)->delete())
        {
            return response()->json(['msg'=>'1']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询顶级权限(使用交叉查询)
        $top = DB::table('auth')->where('pid','=','0')->get();
        //查询一级权限
        $one = DB::table('auth')->where('pid','!=','0')->get();
        //查询权限
        $auth = DB::table('role')->where('id','=',$id)->value('auth_ids');
        
        return view("admin.role.edit",['top'=>$top,'one'=>$one,'id'=>$id,'auth'=>$auth]);
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
        $data = $request->except('_token','_method');
        
        //处理auth_ids的值
        $result['auth_ids'] = implode(',',$data['auth_ids']);
        
        //获取auth_ac SQL:SELECT * FROM auth WHERE pid != 0 and id in (15,16,19,17,18)
        $tmp = DB::table('auth')->where('pid','!=','0')->whereIn('id',$data['auth_ids'])->get();
        
        //将查询出来的结果拼接(控制器@方法，)
        $ac = '';
        foreach($tmp as $key => $val)
        {
            $ac .= $ac . $val->controller.'@'.$val->action.',';
        }
        //去除右边的,
        $result['auth_ac'] = strtolower(rtrim($ac,','));

        //将信息更新到role角色表中
        if(DB::table('role')->where('id','=',$id)->update($result))
        {
            echo 1;
        }else{

            echo 2;
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
