<?php

namespace App\Admin\Controllers;
use App\AdminRole;
use App\AdminUser;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //列表页
    public function index(AdminUser $adminUser){
        if(request()->post()){
            $pageNum = request('page')? request('page') :1;
            $limit = request('limit')? request('limit') :10;
            $page = $pageNum - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
            $res = DB::table('admin_users')->offset($page)->limit($limit)->get();
            $count = DB::table('admin_users')->count();
            return ['code' => 0, 'data' => $res, 'count' => $count];
        }
        return view('admin.user.index');
    }
    //创建管理员
    public function create(){
        return view('admin.user.create');
    }
    //提交管理员
    public function createSubmit(){
        $this->validate(request(),[
            'username'=>'required|min:5|max:30|unique:admin_users,username',
            'password' =>'required|min:5|max:30'
        ]);
        $isShow = request('is_show');
        $isShow = isset($isShow) ? 1: 0;
        $adminsUser = new AdminUser();
        $adminsUser->is_show = $isShow;
        $adminsUser->username = request('username');
        $adminsUser->password = bcrypt(request('password'));
        $res = $adminsUser->save();
        if($res){
            return ['code'=>0,'msg'=>'添加成功'];
        }else{
            return ['code'=>1,'msg'=>'添加失败'];
        }
    }
    //修改管理员
    public function edit(AdminUser $adminUser){
        $roles = \App\AdminRole::all();
        $myRoles = $adminUser->roles;
        return view('admin.user.edit',compact(['adminUser','roles','myRoles']));
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
        $roles = \App\AdminRole::findMany(request('roles'));
        $myRoles = $adminUser->roles;

        // 要增加的
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role) {
            $adminUser->assignRoles($role);
        }

        // 要删除的
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role) {
            $adminUser->deleteRole($role);
        }
        if($res){
            return ['code'=>0,'msg'=>'修改成功'];
        }else{
            return ['code'=>1,'msg'=>'修改失败'];
        }
    }
    //删除管理员
    public function delete(AdminUser $adminUser){
        $res = AdminUser::where('id',$adminUser->id)->delete();
        if($res){
            return ['code'=>0,'msg'=>'删除成功'];
        }else{
            return ['code'=>1,'msg'=>'删除失败'];
        }
    }
    //修改状态
    public function changeStatus(AdminUser $adminUser){
        if($adminUser->is_show==1){
            AdminUser::where('id',$adminUser->id)->update(['is_show'=>0]);
        }else{
            AdminUser::where('id',$adminUser->id)->update(['is_show'=>1]);
        }
        return ['code'=>0,'msg'=>'操作成功'];
    }
}
