<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Adminuser extends Model
{
    //关联模型数据表
    protected $table = 'manager';
    //启用维护时间戳
    public $timestamps = true;
    //可以被批量赋值的属性
    protected $fillable = ['username','password','sex','phone','email','role_id','token','status'];

    //关联角色的模型（一对一）
    public function role()
    {
    	return $this->hasOne('App\Model\Role','id','role_id');
    }

}
