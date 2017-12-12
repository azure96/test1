<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    //图书属于某一个分类
    public function cate(){
    	return $this->belongsTo('\App\Cate');
    }

    //图书和用户是多对多关系
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
