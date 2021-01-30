<?php

namespace App\Admin\Controllers;
use App\AdminUser;
use App\Post;
use App\PostTopic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Sodium\compare;

class PostController extends Controller
{
    //列表页
    public function index(Post $post){
        if(request()->post()){
            $where[] = ['posts.delete_time', '=', '0'];
            $keyword = request('keywords');
            $status = request('status');
            $pageNum = request('page')? request('page') :1;
            $limit = request('limit')? request('limit') :10;
            $page = $pageNum - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            if($keyword){
                $where[] = ['posts.title', 'like', '%'.$keyword.'%'];
            }
            if($status==1){
                $where[] = ['posts.status', '>=', 0];
            }elseif($status==-1){
                $where[] = ['posts.status', '=', -1];
            }
            $res = DB::table('posts')
                ->leftJoin('users','posts.user_id','=','users.id')
                ->select('posts.*','users.name')
                ->where($where)
                ->orderByDesc('posts.id')
                ->paginate($limit??10)->toArray();
            return ['code' => 0, 'data' => $res['data'], 'count' => $res['total']];
        }
        return view('admin.post.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Deng
     * @date 2020-12-11 11:31
     * 添加页面
     */
    public function create(){
        return view('admin.post.create');
    }

    /**
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     * @author Deng
     * @date 2020-12-11 11:34
     * 提交新增
     */
    public function createSubmit(){
        $this->validate(request(),[
            'title'=>'required'
        ]);
        $post = new Post();
        $data = request()->post();
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->status = isset($data['status']) && $data['status'] == 'on' ? 1 : 0;
        $post->user_id = Auth()->id();
        $res = $post->save();
        if($res){
            return ['code'=>0,'msg'=>'添加成功'];
        }else{
            return ['code'=>1,'msg'=>'添加失败'];
        }
    }

    /**
     * @param AdminUser $adminUser
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author Deng
     * @date 2020-12-11 10:25
     * 编辑文章
     */
    public function edit(Post $post){
        return view('admin.post.edit',compact('post'));
    }

    /**
     * @param Post $post
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     * @author Deng
     * @date 2020-12-11 11:21
     * 修改文章
     */
    public function editSubmit(Post $post){
        $data = [];
        $this->validate(request(),[
            'title'=>'required|min:5|max:30',
        ]);
        $is_show = request('status');
        $is_show = isset($is_show) ? 1 : 0;
        $data = ['title'=>request('title'),'status'=>$is_show,'content'=>request('content')];
        $res = Post::where('id',$post->id)->update($data);
        if($res){
            return ['code'=>0,'msg'=>'修改成功'];
        }else{
            return ['code'=>1,'msg'=>'修改失败'];
        }
    }

    /**
     * @param Post $post
     * @return array
     * @author Deng
     * @date 2020-12-11 11:23
     * 删除文章
     */
    public function delete(Post $post){
        $res = Post::where('id',$post->id)->delete();
        //清除专题文章
        PostTopic::where('post_id',$post->id)->delete();
        if($res){
            return ['code'=>0,'msg'=>'删除成功'];
        }else{
            return ['code'=>1,'msg'=>'删除失败'];
        }
    }
    //修改状态
    public function changeStatus(){
        $id = request('id');
        $status =  request('status');
        if($status==1){
            $status = -1;
        }elseif ($status == -1){
            $status = 1;
        }
        if($id){
            DB::table('posts')->where('id',$id)->update(['status'=>$status]);
            return ['code'=>0,'msg'=>'操作成功'];
        }else{
            return ['code'=>1,'msg'=>'操作失败 '];
        }
    }

    public function imageUpload(){
        $path = \request()->file('wangEditorH5File')->store(date('Y-m',time()));
        return asset('storage/'.$path);
    }
}
