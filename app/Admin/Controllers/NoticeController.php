<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/4
 * Time: 11:57
 */
namespace App\Admin\Controllers;

use App\Notices;
use App\Topics;

class NoticeController extends Controller
{
    //
    public function index(){
        $notices = Notices::all();
        //dd($notices->toArray());
        //dd($topics->toArray());
        return view('admin.notice.index',compact('notices'));
    }

    public function create(){
        return view('admin.notice.create');
    }

    public function store(){
        $this->validate(request(),[
            'title'=>'required',
            'content'=>'required'
        ]);
        //dd(request()->all());
        $notice = Notices::create(request(['title','content']));

        // 分发通知
        dispatch(new \App\Jobs\SendMessage($notice));


        // 跳转
        return redirect('/admin/notices');
    }


}