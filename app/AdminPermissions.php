<?php

namespace App;

use App\Model;

class AdminPermissions extends Model
{
    //
    protected $table = 'admin_permissions';

    // 权限属于哪个角色
    public function roles(){
        return $this->belongsToMany(\App\AdminRoles::class,'admin_permissions_role','permissions_id','role_id')
            ->withPivot(['permissions_id','role_id']);
    }


}
