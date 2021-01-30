<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminUser extends Authenticatable
{
    //用户有那些角色
    public function roles(){
        return $this->belongsToMany(\App\AdminRole::class, 'admin_role_user', 'user_id', 'role_id')->withPivot(['user_id', 'role_id']);
    }
    //判断是否有某个角色
    public function isInRoles($roles){
        return !!$roles->intersect($this->roles)->count();
    }
    //用户分配角色
    public function assignRoles($role){
        return $this->roles()->save($role);
    }
    //取消角色和用户的关系
    public function deleteRole($role){
        return $this->roles()->detach($role);
    }
    //用户是否有权限
    public function hasPermission($permission){
        return $this->isInRoles($permission->roles);
    }
}
