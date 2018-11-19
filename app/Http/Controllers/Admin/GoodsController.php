<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Goods;
use App\Admin\Cates;
use DB;
use Input;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询数据
        $data=Goods::get();
        return view('admin.goods.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //判断提交请求
        if (Input::method()=='POST') 
        {
            //实现数据的保存
            //自动验证
           /* $result=Goods::insert
            ([
                'name'          =>  Input::get('name'),
                'typeid'        =>  Input::get('typeid'),
                'sales'         =>  Input::get('sales'),
                'store'         =>  Input::get('store'),
                'price'         =>  Input::get('price'),              
                'status'        =>  Input::get('status'),
                'avatar'        =>  Input::get('avatar'),
            ]);*/
            $data=Input::except('_token','file');
            $result=Goods::insert($data);
            //dd($result);
            //返回输出
             return $result ? '1' :'0';
        }
        else
        {    
            //查询父级分类
            $parents=Cates::where('pid','!=','0')->get();
            return view('admin.goods.add',compact('parents'));
        }
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
        //查询父级分类
        $parents=DB::table('cates')->where('pid','!=','0')->get();
        $data=Goods::where('id',$id)->get();
       return view('admin.goods.edit',compact('data','parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $id = $request->input('id','');
    
        $result=$request->except('_token','file');
        $data=DB::table("goods")->where("id","=",$id)->update($result);
        //返回输出数据
        return $data ? '1' :'0';   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       

        $data=DB::table("goods")->where("id","=",$id)->delete();
         //返回输出数据
        return $data ? '1' :'0';   
    }
}
