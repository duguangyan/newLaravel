<?php

namespace App\Http\Controllers;

use App\Notices;

class NoticeController extends Controller
{
   public function index(){
       // ��ȡ��ǰ�û�
       $user = \Auth::user();
        $notices = Notices::all();
        return view('notice.index',compact('notices'));
   }
}
