<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/4
 * Time: 11:57
 */
namespace App\Admin\Controllers;

use App\Topics;

class TopicController extends Controller
{
    //
    public function index(){
        $topics = Topics::all();
        //dd($topics->toArray());
        return view('admin.topic.index',compact('topics'));
    }

    public function create(){
        return view('admin.topic.create');
    }

    public function store(){
        $this->validate(request(),[
            'name'=>'required'
        ]);
        Topics::create(['name'=>request('name')]);
        return back();
    }

    public function destroy(Topics $topics){
        //dd($topics);
        Topics::delete($topics);

        return [
            'error'=>0,
            'msg'=>'',
            'data'=>$topics
        ];
    }
    public function delete(Topics $topics){
        //dd($topics);
        $topics->delete();
        return back();
//        return [
//            'error'=>0,
//            'msg'=>'',
//            'data'=>$topics
//        ];
    }

}