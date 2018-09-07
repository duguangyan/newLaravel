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
    // Ȩ���б�ҳ��
    public function index(){
        $permissions = AdminPermissions::paginate(10);
        return view('admin.permission.index',compact('permissions'));
    }

    // ����Ȩ��ҳ��
    public function create(){
        return view('admin.permission.add');
    }

    // ����Ȩ����Ϊ
    public function store(){
        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required'
        ]);
        AdminPermissions::create(request(['name','description']));
        return redirect('/admin/permissions');
    }


}