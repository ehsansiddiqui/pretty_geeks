<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sender_id',
        'receiver_id',
        'notification_about',
        'about_id',
        'read',

    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
