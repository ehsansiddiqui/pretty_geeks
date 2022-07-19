<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'file_url',


    ];
    public function post()
    {
        return $this->hasOne('App\Models\Post','id','post_id');
    }
}
