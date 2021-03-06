<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //belongsToMany多对多关联，获取这个专题下的文章
    //\App\Post::class,关联模型
    //post_topics，模型的关联表
    //topic_id，是post_topics关联表的外键
    //post_id是 关联\App\Post::class模型关联表的外键
    public function posts(){
        return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
    }
    //获取专题的文章数,一对多关联,用于withCount
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class,'topic_id');
    }
    //全局
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope('topics',function (Builder $builder){
            $builder->where('status',1)->where('delete_time',0);
        });
    }
}
