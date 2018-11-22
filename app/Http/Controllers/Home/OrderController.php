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

    public function pay(Request $request)
    {

        //var_dump($request->all());exit;
        //dd(session('goods'));
        $data = array();

        $data['member_phone'] = \Cookie::get('username');//用户信息

        $data['orders'] = $request->input('order'); //订单号

        $data['total'] = $request->input('total'); //订单存储总金额

        $data['time'] = time(); //下单时间

        $data['status'] = 1; //订单状态
        
        if(DB::table('orders')->insert($data)){

                $rows = array();

                $rows['address_id'] = $request->input('address_id'); //下单地址的id

                //遍历session的商品
                foreach($request->session()->pull('goods') as $row){

                    $rows['good_id'] = $row['id'];

                    $rows['orders'] = $data['orders'];
                    //$data['member_phone'] = $username;
                    $rows['xiaoji'] = $row['num'] * $row['price'];  //订单详情小计

                    $rows['price'] = $row['price']; //商品价格

                    $rows['num'] = $row['num'];

                    DB::table('orders_info')->insert($rows);
                }

        }

        session(['orders'=>$data['orders']]);
        
        pay($data['orders'],'中国大背包曹');
    }

    public function payss()
    {

        $orders = session('orders');

        DB::table('orders')->where('orders',$orders)->update(['status'=>'2']);

        return redirect('/personal');
    }
}
