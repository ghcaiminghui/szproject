<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Admin\Order;
use Input;
use App\Admin\Cates;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询数据
        $data=Order::get();
        //dd($data);
        //加载分类列表视图
        return view("admin.order.index",compact('data'));
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
            //判断当shop_id在typeid存在的时候才可以添加
            //$data=DB::table('order as t1')->select('t1.shop_id','t2.typeid')->leftJoin('goods as t2','t1.shop_id','=','t2.typeid')->get();
            //dd(Input::get('shop_id'));
            $id=DB::table('goods')->select('typeid')->get()->toArray();         
            //dd($id);
            foreach ($id as $key=>$value) 
            {                             
                if (Input::get('shop_id')==$value->typeid)
                {           
                    /*$result=Order::insert
                    ([
                        'order_no'      =>  Input::get('order_no'),
                        'shop_id'       =>  Input::get('shop_id'),
                        'count'         =>  Input::get('count'),
                        'avatar'        =>  Input::get('avatar'),
                        'country_id'    =>  Input::get('country_id'),
                        'province_id'   =>  Input::get('province_id'),
                        'city_id'       =>  Input::get('city_id'),
                        'county_id'     =>  Input::get('county_id'),
                        'address'       =>  Input::get('address'),           
                        'status'        =>  Input::get('status'),
                    ]);*/
                     //接收数据
                    $data=Input::except('_token','file');
                    $result=Order::insert($data);
                     //返回输出
                    return $result ? '1' :'0';
                }
                else
                {
                    throw new AuthorizationException('该商品不存在');
                }          
                                                   
            }
                  
        }                 
        else
        { 
            //查询父级分类
            //$parents=DB::table('cates')->where('pid','=','0')->get()->toArray();
            $parents=DB::table('cates')->where('pid','!=','0')->get();
            //$children=DB::table('cates')->where('pid','=','id')->get();                 
            //查询数据(国家数据)
            $country=DB::table('area')->where('pid','0')->get();
            return view('admin.order.add',compact('country','parents'));
        }
    }
    //ajax四级联动获取下属地区
    public function getAreaById()
    {
        
        //接收id
        $id=Input::get('id');
        //dd($id);
        //根据id去查下属地区
        $data=DB::table('area')->where('pid',$id)->get();

        //返回输出数据
        return response()->json($data);
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
            $pidinfo = DB::table("order")->where('id','=',$data['pid'])->first();

            //拼接path路径，path格式：父类的path,父类的ID 
            $data['path'] = $pidinfo->path.','.$pidinfo->id;
            
        }

        //将数据插入到数据库
        if(DB::table('order')->insert($data)){

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
        //dd($id);
        //查询数据(国家数据)
        $country=DB::table('area')->where('pid','0')->get();    
        $data=Order::where('id',$id)->get();
        return view('admin.order.edit',compact('data','country'));
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
        $result=$request->except('_token','file','shop_id');
        $data=DB::table("order")->where("id","=",$id)->update($result);
        //返回输出数据
        return $data ? '1' :'0'; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
        $data=DB::table("order")->where("id","=",$id)->delete();
         //返回输出数据
        return $data ? '1' :'0';   
    }
}
