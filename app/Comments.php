<?php

namespace App;

use App\Model;

class Comments extends Model
{
    // 评论所属文章
    public function posts(){
        return $this->belongsTo('App\Posts');
    }

    //评论所属用户名
    public function users(){
        return $this->belongsTo('App\Users');
    }
}
