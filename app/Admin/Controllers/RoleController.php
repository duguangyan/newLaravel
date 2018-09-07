<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/4
 * Time: 11:57
 */
namespace App\Admin\Controllers;

use App\AdminPermissions;
use App\AdminRoles;
use App\AdminUsers;

class RoleController extends Controller
{
    // ��ɫ�б�
    public function index(){
        $roles = AdminRoles::paginate(6);
        return view('admin.role.index',compact('roles'));
    }

    // ������ɫҳ��
    public function create(){
        return view('admin.role.add');
    }

    // ������ɫҳ��
    public function store(){
        // ��֤
        $this->validate(request(),[
           'name'=>'required|min:3',
           'description'=>'required'
        ]);
        // �߼�
        AdminRoles::create(request(['name','description']));
        // ��Ⱦ
        return redirect('admin/roles');
    }

    /*
     * ��ɫ��Ȩ��
     */
    public function permission(AdminRoles $role)
    {


        $permissions = AdminPermissions::all();

        $myPermissions = $role->permissions;
        // dd($myPermissions->toArray());
        return view('/admin/role/permission', compact('permissions', 'myPermissions', 'role'));
    }

    /*s
     * ����Ȩ��
     */
    public function storePermission(AdminRoles $role)
    {
        $this->validate(request(),[
            'permissions' => 'required|array'
        ]);
        $permissions = AdminPermissions::find(request('permissions'));


        $myPermissions = $role->permissions;

        // ���Ѿ��е�Ȩ��
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }

        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role->deletePermission($permission);
        }
        return back();
    }

}