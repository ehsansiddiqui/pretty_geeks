<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'caption',
        'description',
        'image_url',
        'created_at',

    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function postImages()
    {
        return $this->hasMany('App\Models\PostsImages');
    }
    public function PostLike()
    {
        return $this->hasMany('App\Models\PostLike');
    }
    public function DisLike()
    {
        return $this->hasMany('App\Models\DisLike');
    }
    public function comments()
    {
        return $this->morphMany(PostComment::class, 'commentable')->whereNull('parent_id');
    }

    public function postFile()
    {
        return $this->hasMany('App\Models\PostsFile');
    }
    public function postVideos()
    {
        return $this->hasMany('App\Models\PostsVideos');
    }
    public function returnImages($id){
        $images=PostsFile::where('post_id','=',$id)->get();
        $file_urls=array();
//        foreach ($images as $image){
//            $file_urls=$image->file_url;
//        dd($image);
//        }
        return $images;
    }
}
