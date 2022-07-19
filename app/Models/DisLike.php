<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisLike extends Model
{
    use HasFactory;
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
    public function countdislikes($post_id){
        $postdislike=DisLike::where('post_id',$post_id)->get();
        $count=count($postdislike);
        return $count;
    }
}

