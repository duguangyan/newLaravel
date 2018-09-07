<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/4
 * Time: 11:57
 */
namespace App\Admin\Controllers;

use App\AdminPermissions;
use App\AdminUsers;

class PermissionController extends Controller
{
    // 权限列表页面
    public function index(){
        $permissions = AdminPermissions::paginate(10);
        return view('admin.permission.index',compact('permissions'));
    }

    // 创建权限页面
    public function create(){
        return view('admin.permission.add');
    }

    // 创建权限行为
    public function store(){
        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required'
        ]);
        AdminPermissions::create(request(['name','description']));
        return redirect('/admin/permissions');
    }


}