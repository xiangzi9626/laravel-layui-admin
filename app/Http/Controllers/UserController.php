<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
class UserController extends Controller
{
    //修改个人设置页面
    public  function setting(){
        $user = \Auth()->user();
        return view('user.setting',compact('user'));
    }
    //修改个人设置行为
    public function settingStore(){
        $this->validate(\request(),[
            'name'=>'required|max:50'
        ]);
        $name = \request('name');
        $user = \Auth()->user();
        if($name!==$user->name){
            if(User::where('name',$name)->count()>0){
                return back()->withErrors('用户名已被注册');
            }
            $user->name = $name;
        }
        if(\request()->file('avatar')){
            $path = \request()->file('avatar')->store(date('Y-m',time()));
            $path = asset('storage/'.$path);
            $user->avatar = $path;
        }
        $user->save();
        return back();
    }
    //个人中心页面
    public function show(User $user){
        //个人信息，包含关注/粉丝/文章数
        $user = $user->withCount(['fans','stars','posts'])->find($user->id);
        //个人文章列表，去创建时间最新前十条
        $posts = $user->posts()->where('delete_time',0)->orderBy('created_at','desc')->take(10)->get();
        //关注用户，包含关注/粉丝/文章数
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['fans','stars','posts'])->get();
        //粉丝用户，包含关注/粉丝/文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['fans','stars','posts'])->get();
        return view('user.show',compact(['user','posts','susers','fusers']));
    }
    //关注
    public function fan(User $user){
        $me = Auth()->user();
        $me->dofan($user->id);
        return [
            'msg' =>'关注成功',
            'code'=>0
        ];
    }
    //取消关注
    public function unfan(User $user){
        $me = Auth()->user();
        $me->doUnfan($user->id);
        return [
            'msg' =>'取消关注成功',
            'code'=>0
        ];
    }
}
