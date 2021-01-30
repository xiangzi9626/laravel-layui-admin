<?php

namespace App\Http\Controllers;

use App\Zan;
use Illuminate\Http\Request;
use \App\Post;
use \App\Comment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    //文章列表页面
    public function index(){
        $posts = Post::orderBy('created_at','desc')->withCount(['zans','comments'])->paginate(4);
        foreach ($posts as $key => $val){
            $posts[$key]->content = Str::limit($posts[$key]->content,100,'...');
        }
        return view('post.index',compact(['posts']));
    }
    //文章详情页
    public function show(Post $post){
        $post->load('comments');
        //传统方法
        $posts = Comment::where('post_id',$post->id)->get();
        foreach ($posts as $key => $value){
            $user = db::table('users')->where('id',$value->user_id)->first();
            $posts[$key]->name = !empty($user->name) ? $user->name :'';
        }
        return view('post.show',compact(['post','posts']));
    }
    //文章创建页面
    public function create(){
        return view('post.create');
    }
    //文章创建提交
    public function store(){
        $this->validate(request(),[
            'title' =>'required|string|max:100|min:5',
            'content' => 'required|string|min:5'
        ],[
            'title.min' =>'标题不能少于5个字符',
            'title.required' =>'请输入标题',
            'title.max' =>'标题超出长度',
            'content.min' =>'内容不能少于5个字符',
            'content.required' =>'请输入内容',
        ]);
        $user_id = \Auth()->id();
        if(empty($user_id)){
            return redirect('/login')->withErrors('请先登录后发布文章');
        }
        $title = \request('title');
        $content = \request('content');
        $post = Post::create(compact(['user_id','title','content']));
        if($post->incrementing ===true){
            return redirect('/posts');
        }else{
            return back()->withErrors('添加文章失败');
        }
    }
    //文章编辑
    public function edit(Post $post){
        return view('post.edit',compact('post'));
    }
    //文章编辑提交
    public function update(Post $post){
        $this->validate(request(),[
            'title' =>'required|string|max:100|min:5',
            'content' => 'required|string|min:5'
        ],[
            'title.min' =>'标题不能少于5个字符',
            'title.required' =>'请输入标题',
            'title.max' =>'标题超出长度',
            'content.min' =>'内容不能少于5个字符',
            'content.required' =>'请输入内容',
        ]);
        $this->authorize('update',$post);
        Post::where('id',$post->id)->update(['title'=>\request('title'),'content'=>\request('content')]);
        return redirect('/posts/'.$post->id);
    }
    //文章删除页面
    public function del(Post $post){
        Post::where('id',$post->id)->delete();
        return redirect('/posts');
    }
    //文件上传
    public function imageUpload(){
        $path = \request()->file('wangEditorH5File')->store(date('Y-m',time()));
        return asset('storage/'.$path);
    }
    //提交评论
    public function commentStore(Post $post){
        $this->validate(request(),[
            'content' => 'required|string'
        ]);
        $comment = new Comment();
        $comment->user_id = \Auth()->id();
        $comment->content = request('content');
        $comment->post_id = $post->id;
        $comment->save();
        if($comment->incrementing ===true){
            return back();
        }else{
            return back()->withErrors('添加文章失败');
        }
    }
    //点赞
    public function zan(Post $post){
        $param = [
            'user_id' => \Auth()->id(),
            'post_id' =>$post->id
        ];
        Zan::firstOrCreate($param);
        return back();
    }
    //取消赞
    public function unzan(Post $post){
        $post = $post->zan(\Auth()->id())->delete();
        return back();
    }
}
