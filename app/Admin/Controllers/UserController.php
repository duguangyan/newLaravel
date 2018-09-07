<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/4
 * Time: 11:57
 */
namespace App\Admin\Controllers;

use App\AdminRoles;
use App\AdminUsers;

class UserController extends Controller
{
    // 管理员列表页面
    public function index(){
        $users = AdminUsers::orderBy('created_at','desc')->paginate(6);

        return view('admin.user.index',compact('users'));
    }

    // 创建用户页面
    public function create(){
        return view('admin.user.add');
    }

    // 创建操作
    public function store(){
        // 验证
        $this->validate(request(),[
            'name'=>'required|min:3',
            'password'=>'required|max:100'
        ]);
        // 逻辑

        // $user     = request(['name','password']);
        $name     = request('name');
        $password = bcrypt(request('password'));
        $re = AdminUsers::create(compact('name','password'));
        // 渲染

        return redirect('/admin/users');
    }

    // 用户角色页面
    public function role(AdminUsers $users){
        // dd($users->toArray());
        $user = $users;
        $roles = AdminRoles::all();
        $myRoles = $users->roles;
        return view('admin.user.role',compact('roles','myRoles','user'));

    }

    // 储存用户角色
    public function storeRole(AdminUsers $users){
        // 验证
        $this->validate(request(),[
           'roles' =>'required|array'
        ]);
        // 逻辑
        $roles = AdminRoles::findMany(request('roles'));
        $myRoles = $users->roles;

        // 要增加的
        $addRoles = $roles->diff($myRoles);

        foreach ($addRoles as $role){
            $users->assignRole($role);
        }
        // 要删除的
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role){
            $users->assignRole($role);
        }

        return back();

    }


}