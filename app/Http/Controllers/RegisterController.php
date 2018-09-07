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
    // ×¢²áÒ³Ãæ
    public function index(){
        return view('register.index');
    }
    // ×¢²áÐÐÎª
    public function register(){
        // ÑéÖ¤
        $this->validate(request(),[
           'name'     => 'required|min:3|unique:users,name',
           'email'    =>'required|unique:users,email|email',
           'password' => 'required|min:5|max:10|confirmed',
        ]);
        // Âß¼­
        $name     = request('name');
        $email    = request('email');
        $password = bcrypt(request('password'));

        $user = Users::create(compact('name','email','password'));

        // äÖÈ¾
        return redirect('/login');
    }
}