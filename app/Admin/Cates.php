<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Cates extends Model
{
    //定义关联数据表
    protected $table='cates';
    //禁用时间段
    public $timestamps=false;
}
