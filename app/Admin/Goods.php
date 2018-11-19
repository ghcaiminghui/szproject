<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //定义关联数据表
    protected $table='goods';
    //禁用时间段
    public $timestamps=false;
    //关联模型 一对一
    public function cates()
    {
        return $this->hasOne('App\Admin\Cates','id','typeid');
    }

}
