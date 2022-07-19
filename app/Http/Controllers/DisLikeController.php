<?php

namespace App\Http\Controllers;

use App\Events\FriendRequestNotification;
use App\Events\Like;
use App\Events\PostDisLike;
use App\Models\Notification;
use App\Models\DisLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisLikeController extends Controller
{
    public function postdislike(Request $request){
//        dd($request->id);
        if($request){
            $checkdislike=DisLike::where('user_id',Auth::user()->id)->where('post_id',$request->id)->get();
//            dd(count($checklike));
            $action="like";


            if(count($checkdislike) == 0) {
                $dislikepost = DisLike::create([
                    'user_id' => Auth::user()->id,
                    'post_id' => $request->id,
                ]);
                $action="dislike";
                event(new PostDisLike($request->id,$action));


                if($request->user_id != Auth::user()->id){
                    $notification = Notification::create([
                        'user_id' => $request->user_id,
                        'sender_id' => Auth::user()->id,
                        'receiver_id' => $request->user_id,
                        'notification_about' => 'DisLiked your post',
                        'about_id'=>$request->id,
                        'status' => '0',
                    ]);

                    $message="PostDisLike your post";
                    event(new FriendRequestNotification(Auth::user()->name,$request->user_id,$message));


                }
            }else{

                $deletedislike=DisLike::where('user_id',Auth::user()->id)->where('post_id',$request->id)->delete();
                $notification = Notification::where('about_id', $request->id)->where('sender_id',Auth::user()->id)->delete();
                event(new PostDisLike($request->id,$action));
                if($deletedislike){
                    return response()->json(['response'=>" Post liked"]);
                }else{
                    return response()->json(['error'=>"Some error occurs please try again"]);

                }
            }
            return response()->json(['response'=>" Post Disliked"]);
        }else{
            return response()->json(['error'=>"Some error occurs please try again"]);
        }
    }

}
