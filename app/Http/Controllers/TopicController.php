<?php

namespace App\Http\Controllers;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TopicController extends Controller
{
    //专题详情
    public function show(Topic $topic){
        //文章数
        $topic = Topic::withCount('postTopics')->find($topic->id);
        //专题的文章列表
        $posts = $topic->posts()->where('delete_time',0)->orderBy('created_at','desc')->take(10)->get();
        //属于我的文章，不属于该专题的文章
        $myposts = \App\Post::authorBy(\Auth()->id())->topicNot($topic->id)->get();
        
        return view('topic/show',compact(['topic','posts','myposts']));
    }
    //专题投稿
    public function submit(Topic  $topic){
        $this->validate(\request(),[
            'post_ids'=>'required|array'
        ]);
        $topic_id = $topic->id;
        $post_ids = \request('post_ids');
        foreach ($post_ids as $value){
            $post_id = $value;
            \App\PostTopic::firstOrCreate(compact(['topic_id','post_id']));
        }
        return back();
    }
}
