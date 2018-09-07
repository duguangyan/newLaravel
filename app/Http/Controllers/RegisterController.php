<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/8/29
 * Time: 13:31
 */

namespace App\Http\Controllers;

use App\Users;
class RegisterController extends Controller
{
    // ע��ҳ��
    public function index(){
        return view('register.index');
    }
    // ע����Ϊ
    public function register(){
        // ��֤
        $this->validate(request(),[
           'name'     => 'required|min:3|unique:users,name',
           'email'    =>'required|unique:users,email|email',
           'password' => 'required|min:5|max:10|confirmed',
        ]);
        // �߼�
        $name     = request('name');
        $email    = request('email');
        $password = bcrypt(request('password'));

        $user = Users::create(compact('name','email','password'));

        // ��Ⱦ
        return redirect('/login');
    }
}