<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //一对多反向关联
    public function post(){
        return $this->belongsTo('App/Post');
    }
    //一对多反向关联
    public function user(){
        return $this->belongsTo('App/User');
    }
}
