<?php


namespace App\Admin\Controllers;


use App\AdminPermission;
use App\AdminRole;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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
            $where[] = ['delete_time', '=', '0'];
            $keyword = request('keywords');
            if($keyword){
                $where[] = ['name', 'like', '%'.$keyword.'%'];
            }
            $res = DB::table('admin_roles')->where($where)->orderByDesc('id')->offset($page)->limit($limit)->get();
            $count = DB::table('admin_roles')->count();
            return ['code' => 0, 'data' => $res, 'count' => $count];
        }
        return view('admin.role.index');
    }
    //创建 角色页
    public function create(){
        $perList = AdminPermission::all();
        return view('admin.role.create',compact('perList'));
    }
    //提交角色
    public function createSubmit(){
        $this->validate(request(),[
            'name'=>'required|unique:admin_roles,name',
            'description' =>'required|max:250'
        ]);
        $AdminRole = new AdminRole();
        $AdminRole->name = request('name');
        $AdminRole->description = request('description');
        $res = $AdminRole->save();
        if($res){
            return ['code'=>0,'msg'=>'添加成功'];
        }else{
            return ['code'=>1,'msg'=>'添加失败'];
        }
    }
    //编辑权限
    public function editPermission(AdminRole $adminRole){
        //获取所有权限
        $permissionList = AdminPermission::all();
        //获取当前角色权限
        $myPermission = $adminRole->permissions;
        return view('admin.role.edit',compact(['adminRole','permissionList','myPermission']));
    }
    //
    public function editPermissionSubmit(AdminRole $adminRole){
        $this->validate(request(),[
            'permission'=>'required|array',
            'description' =>'required|max:250',
            'name' =>'required|max:250'
        ]);
        $permissions = \App\AdminPermission::findMany(request('permission'));
        $myPermission = $adminRole->permissions;
        $addPermission = $permissions->diff($myPermission);
        //增加对比
        foreach ($addPermission as $permission){
            $adminRole->grantPermission($permission);
        }
        //删除对比
        $deletePermissions = $myPermission->diff($permissions);
        foreach ($deletePermissions as $permission){
            $adminRole->deletePermission($permission);
        }
        return ['code'=>0,'msg'=>'添加成功'];
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
            AdminRole::where('id',$id)->update(['name'=>$name]);
        }elseif (isset($description)){
            $this->validate(request(),[
                'description'=>'required'
            ]);
            AdminRole::where('id',$id)->update(['description'=>$description]);
        }
        return ['code'=>0,'msg'=>'修改成功'];
    }
    //删除角色
    public function delete(AdminRole $adminRole){
        $res = AdminRole::where('id',$adminRole->id)->delete();
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
            DB::table('admin_roles')->delete($value);
        }
        return ['code'=>0,'msg'=>'删除成功'];
    }
}
