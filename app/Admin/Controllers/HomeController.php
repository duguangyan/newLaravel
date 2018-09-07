<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/4
 * Time: 11:57
 */
namespace App\Admin\Controllers;

class HomeController extends Controller
{
    // ตวยผาณ
    public function index(){
        return view('admin.home.index');
    }

}