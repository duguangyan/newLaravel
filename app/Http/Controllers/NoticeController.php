<?php

namespace App\Http\Controllers;

use App\Notices;

class NoticeController extends Controller
{
   public function index(){
       // 获取当前用户
       $user = \Auth::user();
        $notices = Notices::all();
        return view('notice.index',compact('notices'));
   }
}
