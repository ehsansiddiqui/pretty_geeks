<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsImages extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'image_url',


    ];
    public function post()
    {
        return $this->hasOne('App\Models\Post','id','post_id');
    }
}
