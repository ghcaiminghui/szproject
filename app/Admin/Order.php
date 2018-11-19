<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //定义关联数据表
    protected $table='order';
    //禁用时间段
    public $timestamps=false;
    //关联商品模型
   //关联模型 一对一
    public function goods()
    {
        return $this->hasOne('App\Admin\Goods','typeid','shop_id');
    }
}
