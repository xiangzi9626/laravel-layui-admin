<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //用户的文章列表
    public function posts(){
        return $this->hasMany(\App\Post::class,'user_id','id');
    }
    //关注我的fan模型
    public function fans(){
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }
    //我关注的人列表
    public function stars(){
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }
    //我关注某人
    public function dofan($uid){
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }
    //取消关注
    public function doUnfan($uid){
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }
    //当前用户是否被uid关注
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }
    //当前用户是否关注了uid
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }
}
