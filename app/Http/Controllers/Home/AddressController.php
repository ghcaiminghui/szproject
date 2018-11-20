<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->input('id')){
            
            //获取客户信息
            $username = \Cookie::get('username');

            //查询省的数据
            $country = DB::table('zone')->where('pid','0')->get();

            //查询个人的所有收获地址
            $data = DB::table('address')->where('member_phone',$username)->get();

            //将查询出来的省市全部转变中文
            foreach ($data as $value) {
                
                $value->province = $this->convert($value->province);
                $value->city = $this->convert($value->city);
                $value->area = $this->convert($value->area);
                $value->town = $this->convert($value->town);
            }
            
            return view("home.personalCenter.address",compact('username','country','data'));

        }else{
            //获取一级的id
            $id = $request->input('id');
            //根据一级的id查询二级数据
            $data = DB::table('zone')->where('pid',$id)->get();

            return response()->json($data);
        }
    }

    //城市id转换为中文
    public function convert($id)
    {
        $data = DB::table('zone')->where('id',$id)->first();
        return $data->area;
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
        $data = $request->except('_token');

        $data['member_phone'] = \Cookie::get('username');

        //代表地址设置默认地址,将其他设置为0
        if(isset($data['status']) == '1'){

            DB::table('address')->where('member_phone',\Cookie::get('username'))->update(['status'=>'0']);
        }

        //添加操作
        if(DB::table('address')->insert($data)){

            return redirect('/personal/address');
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
        $username = \Cookie::get('username');

        DB::table('address')->where('member_phone',$username)->update(['status'=>'0']);

        if(DB::table('address')->where('id',$id)->update(['status'=>'1'])){

            return redirect('/personal/address');
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
        
        // //获取客户信息
        $username = \Cookie::get('username');

        //查询省的数据
        $country = DB::table('zone')->where('pid','0')->get();

        //查询个人的所有收获地址
        $data = DB::table('address')->where('member_phone',$username)->get();

        //将查询出来的省市全部转变中文
        foreach ($data as $value) {
                
            $value->province = $this->convert($value->province);
            $value->city = $this->convert($value->city);
            $value->area = $this->convert($value->area);
            $value->town = $this->convert($value->town);
        }
        //查询要修改的id
        $info = DB::table('address')->where('id',$id)->first();
        $info1 = DB::table('address')->where('id',$id)->first();
        $info->city = $this->convert($info->city);
        $info->area = $this->convert($info->area);
        $info->town = $this->convert($info->town);
       
        return view("home.personalCenter.addedit",compact('username','country','data','info','info1'));

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
        
        //代表地址设置默认地址,将其他设置为0
        if(isset($data['status']) == '1'){

            DB::table('address')->where('member_phone',\Cookie::get('username'))->update(['status'=>'0']);
        }

        if(DB::table('address')->where('id',$id)->update($data)){

            return redirect('/personal/address');
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
        if(DB::table('address')->where('id',$id)->delete()){

            return response()->json(['msg'=>'1']);
        }
    }

}
