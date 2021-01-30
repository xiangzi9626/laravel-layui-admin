<?php


namespace App\Admin\Controllers;


use App\AdminPermission;
use App\AdminRole;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    //列表页
    public function index(){
        if(request()->post()){
            $pageNum = request('page')? request('page') :1;
            $limit = request('limit')? request('limit') :10;
            $page = $pageNum - 1;
            if ($page != 0) {
                $page = $limit * $page;
            }
//            $where[] = ['delete_time', '=', '0'];
            $where = [];
            $keyword = request('keywords');
            if($keyword){
                $where[] = ['name', 'like', '%'.$keyword.'%'];
            }
            $res = DB::table('admin_permissions')->where($where)->orderByDesc('id')->offset($page)->limit($limit)->get();
            $count = DB::table('admin_permissions')->count();
            return ['code' => 0, 'data' => $res, 'count' => $count];
        }
        return view('admin.permission.index');
    }
    //创建 角色页
    public function create(){
        return view('admin.permission.create');
    }
    //提交角色
    public function createSubmit(){
        $this->validate(request(),[
            'name'=>'required|unique:admin_roles,name',
            'description' =>'required|max:250'
        ]);
        $AdminRole = new AdminPermission();
        $AdminRole->name = request('name');
        $AdminRole->description = request('description');
        $res = $AdminRole->save();
        if($res){
            return ['code'=>0,'msg'=>'添加成功'];
        }else{
            return ['code'=>1,'msg'=>'添加失败'];
        }
    }
    //修改管理员
    public function edit(){
        $id = request('id');
        $name = request('name');
        $description =  request('description');
        if(isset($name)){
            $this->validate(request(),[
                'name'=>'required'
            ]);
            AdminPermission::where('id',$id)->update(['name'=>$name]);
        }elseif (isset($description)){
            $this->validate(request(),[
                'description'=>'required'
            ]);
            AdminPermission::where('id',$id)->update(['description'=>$description]);
        }
        return ['code'=>0,'msg'=>'修改成功'];
    }
    //删除权限
    public function delete(AdminPermission $adminPermission){
        $res = AdminPermission::where('id',$adminPermission->id)->delete();
        if($res){
            return ['code'=>0,'msg'=>'删除成功'];
        }else{
            return ['code'=>1,'msg'=>'删除失败'];
        }
    }
    //批量删除
    public function deleteAll(){
        $ids = request('ids');
        foreach (explode(',',$ids) as $value){
            DB::table('admin_permissions')->delete($value);
        }
        return ['code'=>0,'msg'=>'删除成功'];
    }
}
