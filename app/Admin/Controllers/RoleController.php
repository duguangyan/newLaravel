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
    // 角色列表
    public function index(){
        $roles = AdminRoles::paginate(6);
        return view('admin.role.index',compact('roles'));
    }

    // 创建角色页面
    public function create(){
        return view('admin.role.add');
    }

    // 创建角色页面
    public function store(){
        // 验证
        $this->validate(request(),[
           'name'=>'required|min:3',
           'description'=>'required'
        ]);
        // 逻辑
        AdminRoles::create(request(['name','description']));
        // 渲染
        return redirect('admin/roles');
    }

    /*
     * 角色的权限
     */
    public function permission(AdminRoles $role)
    {


        $permissions = AdminPermissions::all();

        $myPermissions = $role->permissions;
        // dd($myPermissions->toArray());
        return view('/admin/role/permission', compact('permissions', 'myPermissions', 'role'));
    }

    /*s
     * 保存权限
     */
    public function storePermission(AdminRoles $role)
    {
        $this->validate(request(),[
            'permissions' => 'required|array'
        ]);
        $permissions = AdminPermissions::find(request('permissions'));


        $myPermissions = $role->permissions;

        // 对已经有的权限
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