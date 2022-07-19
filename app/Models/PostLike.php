<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
    public function countlikes($post_id){
        $postlike=PostLike::where('post_id',$post_id)->get();
        $count=count($postlike);
        return $count;
    }
}
