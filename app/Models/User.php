<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasFactory, Notifiable;
    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'mobile_number',
        'sex',
        'dob',
        'provider',
        'provider_id',
        'key',
        'avatar',
        'status',
        'verified_token',
        'email_verified',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    public function friendrequests()
    {
        return $this->hasMany('App\Models\FriendRequest');
    }
    public function PostLike()
    {
        return $this->hasMany('App\Models\PostLike');
    }
    public function DisLike()
    {
        return $this->hasMany('App\Models\DisLike');
    }
    public function friends()
    {
        return $this->hasMany('App\Models\Friend');
    }
    public function usernotifications( )
    {
        return $this->hasMany('App\Models\Notification');
    }
    public function getusers($id){
//        dd($id);
         $request=User::where('id', $id)->where('email_verified',[1])->get();
//        dd($request);
         return $request[0]->name;
    }
    public function getuserdp($id){
//        dd($id);
        $friend=User::find($id);
//        $request=User::where('id', $id)->where('email_verified',[1])->get();
//        dd($request);
        return $friend->avatar;
    }
}
