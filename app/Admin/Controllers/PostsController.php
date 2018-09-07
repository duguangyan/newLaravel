<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/4
 * Time: 11:57
 */
namespace App\Admin\Controllers;

use App\Posts;

class PostsController extends Controller
{
    // µÇÂ¼Ò³
    public function index(){
        $posts = Posts::withoutGlobalScope('avaiable')->where('status',0)->orderBy('created_at','desc')->paginate(6);
        return view('admin.post.index',compact('posts'));
    }

    public function status(Posts $posts){
        // TODO :
        // ÑéÖ¤
        $this->validate(request(),[
            'status' =>'required|in:-1,1'
        ]);
        // Âß¼­
        $posts->status = request('status');
        $posts->save();
        // äÖÈ¾
        return [
          'err'=>'0',
          'msg'=>'xxx'
        ];
    }

}