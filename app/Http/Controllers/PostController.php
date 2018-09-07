<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/8/28
 * Time: 10:33
 */

namespace App\Http\Controllers;
use \App\Comments;
use \App\Posts;
use \App\Users;
use \App\Zans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    // 列表页面
    public function index()
    {
        $user = \Auth::user();
        $posts = Posts::orderBy('created_at', 'desc')->withCount(["zans", "comments"])->with(['user'])->paginate(6);
        //  dd($posts->toarray());
        return view('post/index', compact('posts'));
    }

    // 详情页
    public function show(Posts $posts){
        $posts->load('comments');
        $user_id = Auth::id();
        return view('post/show',compact('posts','user_id'));
    }

    // 创建文章
    public function create(){
        return view('post/create');
    }

    // 创建文章逻辑
    public function store(){


// 第一种
//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        $post->save();
// 第二张
        // $params = ['title'=>request('title'),'content'=>request('content')];
        // 第三者
        // $params = request(['title','content']);
        // 验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ]);
        // 逻辑
        $user_id = Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));
        Posts::create($params);
        // 渲染
        return redirect('/posts');
        // dd(request());
    }

    // 编辑页面
    public function edit(Posts $posts){
        return view('post/edit',compact('posts'));
    }

    // 更新逻辑页面
    public function update(Posts $posts){
        // 验证
        $this->validate(request(),[
           'title'   => 'required|string|max:100|min:5',
           'content' => 'required|string|min:10'
        ]);
        // 逻辑
        // TODO: 修改权限认证
        $this->authorize('update',$posts);


        $posts->title = request('title');
        $posts->content = request('content');
        $posts->save();
        // Posts::updated(request(['title','content']));
        // 渲染
        return redirect('/posts/'.$posts->id);
    }

    // 删除页面
    public function delete(Posts $posts){
        // TODO: 用户权限认证
        $this->authorize('delete',$posts);

        $posts->delete();
        return redirect('/posts');
    }

    // 图片上传
    public function imageUplode(Request $request){
        // dd(request()->all());
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));

        return asset('storage/'.$path);
    }

    // 提交评论
    public function comment(Posts $posts){
        //sdd(request()->toArray());
        // 验证
       $this->validate(request(),[
            'content' => 'required|min:1'
       ]);
       // 逻辑
        $comments = new Comments();
        $comments->users_id = Auth::id();
        $comments->content = request("content");
        $posts->comments()->save($comments);
       //渲染
       return back();
    }

    // 赞
    public function zan(Posts $posts){

        // dd($posts);

        $param = [
          'users_id' => Auth::id(),
          'posts_id' => $posts->id
        ];
        Zans::firstOrCreate($param);
        return back();
    }

    // 取消赞
    public function unzan(Posts $posts){

        $posts->zan(Auth::id())->delete();
        return back();
    }

    // 查询
    public function search(){
//        $this->validate(request(),[
//            'content' => 'required'
//        ]);

        $query = request('query');
        $posts  = Posts::where('content','like','%'.$query.'%')->orderBy('created_at','desc')->withCount(["comments",'zans'])->paginate(6);
        // dd($posts);
        // return view('post/index',compact('posts','query'));
        return view('post/index',compact(['posts','query']));
    }

}