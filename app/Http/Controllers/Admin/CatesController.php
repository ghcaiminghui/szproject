<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        //加载分类列表视图
        return view("admin.cates.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //查询分类表数据，并分配到视图
        $cate = DB::table("cates")->get();
        //加载分类添加视图
        return view("admin.cates.add",["cate" => $cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收排除_token以外的值
        $data = $request->except('_token');

        //判断添加的是顶级分类还是子分类
        if($data['pid'] == 0){

            $data['path'] = '0'; //注意看数据表的设置，varchar是设置字符串，加引号
            
        }else{

            //根据pid获取它父类的信息
            $pidinfo = DB::table("cates")->where('id','=',$data['pid'])->first();

            //拼接path路径，path格式：父类的path,父类的ID 
            $data['path'] = $pidinfo->path.','.$pidinfo->id;
            
        }

        //将数据插入到数据库
        if(DB::table('cates')->insert($data)){

            echo 1;
        }else{

            echo 2;
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
