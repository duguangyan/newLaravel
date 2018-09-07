<?php

namespace App;

use App\Model;

class AdminRoles extends Model
{
    protected $table = 'admin_roles';
    // 当前角色的所有权限
    public function permissions(){
        return $this->belongsToMany(AdminPermissions::class,'admin_permissions_role','role_id','permissions_id')
            ->withPivot(['permissions_id','role_id']);
    }
    // 给角色权限赋值
    public function grantPermission($permission){
        return $this->permissions()->save($permission);
    }
    // 取消角色赋予的权限
    public function deletePermission($permission){
        return $this->permissions()->detach($permission);
    }

    //判断角色是否有权限
    public function hasPermission($permission){
        return $this->permissions()->contains($permission);
    }

}
