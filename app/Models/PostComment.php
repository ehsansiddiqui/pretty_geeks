<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }
    public function countcomments($post_id){
        $comments=PostComment::where('commentable_id',$post_id)->get();
        $count=count($comments);
        return $count;
    }
}
