<?php

namespace App;

use App\Model;

class Comments extends Model
{
    // ������������
    public function posts(){
        return $this->belongsTo('App\Posts');
    }

    //���������û���
    public function users(){
        return $this->belongsTo('App\Users');
    }
}
