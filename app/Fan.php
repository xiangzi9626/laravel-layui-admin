<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $fillable=['fan_id','star_id'];
    //粉丝用户
    //\App\User::class，关联模型
    //id,是user表的主键
    //fan_id，是fan表的外键，fan_id关联user表的id
    public function fuser(){
        return $this->hasOne(\App\User::class,'id','fan_id');
    }

    //被关注用户
    public function suser(){
        return $this->hasOne(\App\User::class,'id','star_id');
    }



}
