<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //公共方法
    public function getcatesbypid($pid){

        $res=DB::table("cates")->where("pid",'=',$pid)->get();
        // dd($res);
        $data=[];
        //遍历 把对应的子类信息 添加到suv下标里
        foreach($res as $key=>$value){
            $value->suv=$this->getcatesbypid($value->id);
            $data[]=$value;
        }
        return $data;
    }

    public function index(Request $request)
    {
        //当前请求不是Ajax
        if(!$request->ajax()){
            
            $cate=$this->getcatesbypid(0);
            //获取前五条数据
            $good=DB::select("select * from goods limit 8");
            
            $username = \Cookie::get('username');
            //dd($cate);
            //加载前台模板
            return view("home.index.index",compact("username",'cate','good'));

        }
        //获取附加参数子类id
        $id=$request->input('id');
        // echo $id;
        //获取当前子类下的商品数据
        $data=DB::table("cates")->join("goods","cates.id",'=','goods.typeid')->select("cates.name as cname","cates.id as cid","goods.name as gname","goods.typeid as gtypeid","goods.avatar")->where("goods.typeid",'=',$id)->get();
        echo json_encode($data);
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
