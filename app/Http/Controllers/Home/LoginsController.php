<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;
use Hash;


class LoginsController extends Controller
{
 
    /**
     * 加载登录和注册的视图
     *
     */
    public function index(Request $request)
    {  

        //dd($request->cookie('message'));
        return view("home.index.login");
    }


    /**
     * 登录检查账号和密码
     *
     */
    public function matchlogin(Request $request)
    {

    	//存储发过来的账号和密码
        $phone = $request->input('phone');
        $password = $request->input('password');

        if($info = Member::where('phone','=',$phone)->first()){

        	//检查密码
            if(Hash::check($password,$info->password)){

            	//用户信息存储到cookie,成功返回1
                \Cookie::queue('username',$info->phone,120);
                return response()->json(['msg'=>'1']);

            }else{
            	//失败返回0
                return response()->json(['msg'=>'0']);
            }

        }else{
            //你输入的密码和账户名不匹配
            return response()->json(['msg'=>'0']);
        }
    }


    /**
     * 退出登录
     *
     */
    public function logout ()
    {
        //清除cookie
        \Cookie::queue(\Cookie::forget('username'));

        return redirect("/");
    }


    /**
     * 发送短信
     *
     */
    public function sendmessage(Request $request)
    {

        $phone = $request->input('phone');
        //发送短信
        return sendphone($phone);
        //return response()->json(['code'=>'000000']);
    }


    /**
     * 注册提交过来，负责检查手机号是否存储和验证码是否匹配
     *
     * @param  int  $id
     * @return msg=0验证码不正确|msg=1注册成功|2是手机号存在|3验证码为空
     */
    public function registered(Request $request)
    {
    
    	
    	$smscode = $request->input('smscode');
    	$phone = $request->input('phone');
    	$password = $request->input('password');

    	//判断验证码和客户发过来的验证码是否存在
    	if(isset($_COOKIE['smscode']) && !empty($smscode))
    	{

    		//都存在就进行比对
    		if($request->cookie('smscode') == $smscode)
    		{

    			if(Member::where('phone','=',$phone)->first()){

    				//手机号已存在
    				return response()->json(['msg'=>'2']);

    			}else{

    				$data['username'] = $phone;
    				$data['phone'] = $phone;
    				$data['password'] = Hash::make($password);
    				$data['status'] = 1;
    				$data['type'] = 1;
    				$data['token'] = str_random(50);

    				if(Member::create($data)){

    					//注册成功将用户信息存入cookie和返回成功信息
    					\Cookie::queue('username',$data['phone'],120);

    					return response()->json(['msg'=>'1']);
    				}
    			}

    		}else{

    			//验证码不正确
    			return response()->json(['msg'=>'0']);
    		}
    	}else{

    		//验证码为空
    		return response()->json(['msg'=>'3']);
    	}
    }


    /**
     * 密码重置
     *
    */
    public function reset(Request $request)
    {

    	$smscode = $request->input('smscode');
    	$phone = $request->input('phone');
    	$password = $request->input('password');

	    //判断验证码和客户发过来的验证码是否存在
	    if(isset($_COOKIE['smscode']) && !empty($smscode))
	    {

	    	//都存在就进行比对
	    	if($request->cookie('smscode') == $smscode)
	    	{

	    		if(Member::where('phone','=',$phone)->first()){

	    			//手机号已存在,代表修改密码
	    			if(!empty($password)){

	    				$data['token'] = str_random(50);
	    				$data['password'] = Hash::make($password);

	    				if(Member::where('phone','=',$phone)->update($data)){

	    					\Cookie::queue('username',$phone,120);

	    					return response()->json(['msg'=>'1']);
	    				}
	    			}

	    		}else{

	    			//用户不存在请注册
	    			return response()->json(['msg'=>'2']);
	    		}

	    	}else{

	    		//验证码不正确
	    		return response()->json(['msg'=>'0']);
	    	}
	    }else{

	    	//验证码为空
	    	return response()->json(['msg'=>'3']);		
	    }
	    
    }

}
