<?php

namespace App\Providers;

use App\Models\FriendRequest;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        View::composer('*', function($view) {
            if (Auth::check()) {
                $notifications = Notification::where('user_id', '=', Auth::user()->id)->get();
                $count = count($notifications);
                $postlike=PostLike::all();
                $comments=PostComment::where('parent_id',null)->get();
                $reply=PostComment::whereNotNull('parent_id')->get();
                $userfriends = FriendRequest::where('user_id', '=', Auth::user()->id)->orwhere('friend_id', '=', Auth::user()->id)->where('status','=',1)->get();

//                $friendposts = FriendRequest::where('user_id', '=', Auth::user()->id)->where('status',1)->pluck('friend_id')->toArray();
//                $friendsuserposts = FriendRequest::where('friend_id', '=', Auth::user()->id)->where('status',1)->pluck('user_id')->toArray();
//                $post=Post::whereIn('user_id', [Auth::user()->id])->orwhereIn('user_id',$friendsuserposts)->orwhereIn('user_id',$friendposts)->get();


                view()->share('notifications', $notifications);
                view()->share('postlikes', $postlike);
                view()->share("comments",$comments);
                view()->share("replies",$reply);
                view()->share("friendswith",$userfriends);

                View::share('ncount', $count);
            }
        });
    }
}
