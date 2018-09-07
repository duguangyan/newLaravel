<?php

namespace App;

use App\Model;

class AdminRoles extends Model
{
    protected $table = 'admin_roles';
    // ��ǰ��ɫ������Ȩ��
    public function permissions(){
        return $this->belongsToMany(AdminPermissions::class,'admin_permissions_role','role_id','permissions_id')
            ->withPivot(['permissions_id','role_id']);
    }
    // ����ɫȨ�޸�ֵ
    public function grantPermission($permission){
        return $this->permissions()->save($permission);
    }
    // ȡ����ɫ�����Ȩ��
    public function deletePermission($permission){
        return $this->permissions()->detach($permission);
    }

    //�жϽ�ɫ�Ƿ���Ȩ��
    public function hasPermission($permission){
        return $this->permissions()->contains($permission);
    }

}
