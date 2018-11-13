<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //关联的数据表
    protected $table = 'member';

    //时间戳开启
    public $timestamps = true;

    //可以被批量复制
    protected $fillable = ['status'];
}
