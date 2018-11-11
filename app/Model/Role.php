<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    //模型关联的数据表
    protected $table = 'role';
    //维护时间戳
    public $timestamps = false;
    //批量赋值的属性
    //protected $fillable = [];

    //将分派的权限进行处理
    // public function assignAuth($data)
    // {
    //     //处理auth_ids的值
    //     $post['auth_ids'] = implode(',',$data['auth_ids']);

    //     //获取auth_ac SQL:SELECT * FROM auth WHERE pid != 0 and id in (1,2,3,16,8) 
    //     $tmp = DB::table('auth')->where('pid','!=','0')->whereIn('id',$post['auth_ids'])->get();

    //     //将查询出来的结果拼接(控制器@方法，)
    //     $ac = '';
    //     foreach($tmp as $key => $val)
    //     {

    //         $ac .= $ac . $val->controller.'@'.$val->action.',';
    //     }
    //     $post['auth_ac'] = rtrim($ac,',');
    //     var_dump($post);exit();

    //     //return self::where('id','=',$data['id'])->update();
    // }
}
