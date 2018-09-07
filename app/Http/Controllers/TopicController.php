<?php

namespace App\Http\Controllers;
use App\Topics;
use App\Posts;
class TopicController extends Controller
{
    //
    public function show(Topics $topic){
        // 专题文章列表
        // dd($topic->toArray());
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
         //dd($posts);
        // 专题文章数
        $topics = Topics::withCount('postTopics')->find($topic->id);
         //dd($topics);

        $me = \Auth::user();
        // 属于我的文章，但是未投稿
        // dd(\Auth::id());
        $myposts = Posts::AuthorBy(\Auth::id())->topicNotBy($topics->id)->get();

        // dd($myposts->toArray());


        return view('topic.show',compact('topic','posts','myposts'));

    }

    public function submit(Topics $topic){
        $this->validate(request(),[
            'post_ids' => 'array'
        ]);

        // 确认这些post都是属于当前用户的
        $posts = \App\Posts::find(request(['post_ids']));
        foreach ($posts as $post) {
            if ($post->user_id != \Auth::id()) {
                return back()->withErrors(array('message' => '没有权限'));
            }
        }


        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id){
            \App\PostTopics::firstOrCreate(compact('topic_id', 'post_id'));
        }
        return back();
    }
}
