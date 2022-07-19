<?php

namespace App\Http\Controllers;

use App\Events\FriendRequestNotification;
use App\Events\Like;
use App\Models\FriendRequest;
use App\Models\Notification;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{

    public function postlike(Request $request){
//        dd($request);
        if($request){
            $checklike=PostLike::where('user_id',Auth::user()->id)->where('post_id',$request->id)->get();
//            dd(count($checklike));
            $action="dislike";


            if(count($checklike) == 0) {
                $likepost = PostLike::create([
                    'user_id' => Auth::user()->id,
                    'post_id' => $request->id,
                ]);
                $action="like";
                event(new Like($request->id,$action));


            if($request->user_id != Auth::user()->id){
            $notification = Notification::create([
                'user_id' => $request->user_id,
                'sender_id' => Auth::user()->id,
                'receiver_id' => $request->user_id,
                'notification_about' => 'Liked your post',
                'about_id'=>$request->id,
                'status' => '0',
            ]);

            $message="Like your post";
                 event(new FriendRequestNotification(Auth::user()->name,$request->user_id,$message));


            }
            }else{

                $deletelike=PostLike::where('user_id',Auth::user()->id)->where('post_id',$request->id)->delete();
                $notification = Notification::where('about_id', $request->id)->where('sender_id',Auth::user()->id)->delete();
                event(new Like($request->id,$action));
                if($deletelike){
                    return response()->json(['response'=>" Post dislike"]);
                }else{
                    return response()->json(['error'=>"Some error occurs please try again"]);

                }
            }
            return response()->json(['response'=>" Post liked"]);
        }else{
            return response()->json(['error'=>"Some error occurs please try again"]);
        }
    }

}
