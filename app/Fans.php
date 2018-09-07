<?php

namespace App;

use App\Model;

class Fans extends Model
{
    // 粉丝用户
    public function fuser(){
        return $this->hasOne(Users::class,'id','fan_id');
    }

    // 被关注的用户
    public function suser(){
        return $this->hasOne(Users::class,'id','star_id');
    }
}
