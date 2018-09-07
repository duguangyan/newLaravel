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
    // ����Ա�б�ҳ��
    public function index(){
        $users = AdminUsers::orderBy('created_at','desc')->paginate(6);

        return view('admin.user.index',compact('users'));
    }

    // �����û�ҳ��
    public function create(){
        return view('admin.user.add');
    }

    // ��������
    public function store(){
        // ��֤
        $this->validate(request(),[
            'name'=>'required|min:3',
            'password'=>'required|max:100'
        ]);
        // �߼�

        // $user     = request(['name','password']);
        $name     = request('name');
        $password = bcrypt(request('password'));
        $re = AdminUsers::create(compact('name','password'));
        // ��Ⱦ

        return redirect('/admin/users');
    }

    // �û���ɫҳ��
    public function role(AdminUsers $users){
        // dd($users->toArray());
        $user = $users;
        $roles = AdminRoles::all();
        $myRoles = $users->roles;
        return view('admin.user.role',compact('roles','myRoles','user'));

    }

    // �����û���ɫ
    public function storeRole(AdminUsers $users){
        // ��֤
        $this->validate(request(),[
           'roles' =>'required|array'
        ]);
        // �߼�
        $roles = AdminRoles::findMany(request('roles'));
        $myRoles = $users->roles;

        // Ҫ���ӵ�
        $addRoles = $roles->diff($myRoles);

        foreach ($addRoles as $role){
            $users->assignRole($role);
        }
        // Ҫɾ����
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role){
            $users->assignRole($role);
        }

        return back();

    }


}