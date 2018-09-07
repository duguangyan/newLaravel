<?php

namespace App;

use App\Model;

class AdminPermissions extends Model
{
    //
    protected $table = 'admin_permissions';

    // Ȩ�������ĸ���ɫ
    public function roles(){
        return $this->belongsToMany(\App\AdminRoles::class,'admin_permissions_role','permissions_id','role_id')
            ->withPivot(['permissions_id','role_id']);
    }


}
