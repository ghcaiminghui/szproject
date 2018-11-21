<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = $request->all();

        $request->session()->push('goods',$data);
        //
        return response()->json(['msg'=>'1']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //$data = $request->session()->all();

        $username = \Cookie::get('username');//用户信息

        //收货地址
        $address = DB::table('address')->where('member_phone',$username)->get();
        //收货地址转换
        foreach($address as $value){

            $value->province = $this->convert($value->province);
            $value->city = $this->convert($value->city);
            $value->area = $this->convert($value->area);
            $value->town = $this->convert($value->town);

        }

        //查询商品信息
        $goods = session('goods');
        
        //dd($goods);
        return view('home.order.index',compact('username','address','goods'));
    }

    //城市id转换为中文
    public function convert($id)
    {
        $data = DB::table('zone')->where('id',$id)->first();
        return $data->area;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
