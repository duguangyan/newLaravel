<?php

namespace App;

use App\Model;

class Fans extends Model
{
    // ��˿�û�
    public function fuser(){
        return $this->hasOne(Users::class,'id','fan_id');
    }

    // ����ע���û�
    public function suser(){
        return $this->hasOne(Users::class,'id','star_id');
    }
}
