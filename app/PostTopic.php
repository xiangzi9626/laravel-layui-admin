<?php
/**
 * 文章和专题的关系表
 */
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class PostTopic extends Model
{
    protected $fillable=[
        'topic_id','post_id'
    ];
    //使用scope过滤属于当前用户的文章
    public function scopeAuthorBy(Builder $query,$user_id){
        return $query->where('user_id',$user_id);
    }
    //使用一对多关联post
    public function postTopic(){
        return $this->hasMany(\App\Topic::class,'post_id');
    }
    //不属于当前专题的文章
    public function scopeNotTopic(Builder $query ,$topic_id){
        return $query->doesntHave('postTopic','and',function ($q) use($topic_id) {
            $q->where('topic_id',$topic_id);
        });
    }
}
