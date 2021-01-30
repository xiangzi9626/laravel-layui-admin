<?php

namespace App\Admin\Controllers;
use App\Topic;
use Illuminate\Support\Facades\DB;
class TopicController extends Controller
{
    //列表页
    public function index(){
        if(request()->post()){
            $where[] = ['delete_time', '=', '0'];
            $keyword = request('keywords');
            $status = request('status');
            $pageNum = request('page')? request('page') :1;
            $limit = request('limit')? request('limit') :10;
            $page = $pageNum - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            if($keyword){
                $where[]= ['name', 'like', '%'.$keyword.'%'];
            }
            if($status==1){
                $where[]= ['status', '>=', 0];
            }elseif($status==-1){
                $where[]= ['status', '=', -1];
            }
            $res = DB::table('topics')
                ->where($where)
                ->orderByDesc('id')
                ->offset($page)->limit($limit)->get();
            $count = DB::table('topics')->count();
            return ['code' => 0, 'data' => $res, 'count' => $count];
        }
        return view('admin.topic.index');
    }
    //创建专题
    public function create(){
        return view('admin.topic.create');
    }
    //提交专题
    public function createSubmit(){
        $this->validate(request(),[
            'name'=>'required|max:30',
        ]);
        $isShow = request('status');
        $isShow = isset($isShow) ? 1: 0;
        $adminsUser = new Topic();
        $adminsUser->status = $isShow;
        $adminsUser->name = request('name');
        $res = $adminsUser->save();
        if($res){
            return ['code'=>0,'msg'=>'添加成功'];
        }else{
            return ['code'=>1,'msg'=>'添加失败'];
        }
    }
    //修改管理员
    public function edit(){
        $this->validate(request(),[
            'name'=>'required'
        ]);
        $id = request('id');
        $name = request('name');
        if($id){
            Topic::where('id',$id)->update(['name'=>$name]);
            return ['code'=>0,'msg'=>'修改成功'];
        }else{
            return ['code'=>1,'msg'=>'修改失败'];
        }
    }
    //修改管理员操作
    public function editSubmit(AdminUser $adminUser){
        $data = [];
        $this->validate(request(),[
            'username'=>'required|min:5|max:30',
        ]);
        $is_show = request('is_show');
        $is_show = isset($is_show) ? 1 : 0;
        if(isset($password)){
            $password = bcrypt(request('password'));
            $data['password'] = $password;
        }
        $data = ['username'=>request('username'),'is_show'=>$is_show];
        $res = AdminUser::where('id',$adminUser->id)->update($data);
        if($res){
            return ['code'=>0,'msg'=>'修改成功'];
        }else{
            return ['code'=>1,'msg'=>'修改失败'];
        }
    }
    //删除专题
    public function delete(Topic $topic){
        $res = Topic::where('id',$topic->id)->update(['delete_time'=>time()]);
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
            DB::table('topics')->where('id',$id)->update(['status'=>$status]);
            return ['code'=>0,'msg'=>'操作成功'];
        }else{
            return ['code'=>1,'msg'=>'操作失败 '];
        }


    }
}
