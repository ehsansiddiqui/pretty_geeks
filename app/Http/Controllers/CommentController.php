<?php

namespace App\Http\Controllers;

use App\Events\Comment;
use App\Events\FriendRequestNotification;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postcomment(Request $request){
//        $user=$request->user();
        $comment = new PostComment;

        $comment->comment = $request->comment;

        $comment->user()->associate($request->user());

        $post = Post::find($request->post_id);
//        dd($post->user_id);

        $action="comment";
        if($post->comments()->save($comment)){
//            dd($comment->id);
            if(Auth::user()->id != $post->user_id){
            $notification = Notification::create([
                'user_id' => $post->user_id,
                'sender_id' => Auth::user()->id,
                'receiver_id' => $post->user_id,
                'notification_about' => 'Commented on your post',
                'about_id'=>$post->id,
                'status' => '0',
            ]);
                $message='Commented on your post';
//            event(new App\Events\FriendRequestNotification('Someone'));
                event(new FriendRequestNotification(Auth::user()->name,$post->user_id,$message));
            }
            event(new Comment(Auth::user()->name,$request->post_id,$request->comment,$action,$comment->id,$post->user_id));

            return response()->json(['response'=>'Post Comment Successfully']);

        }else{
            return response()->json(['error'=>" Some Error occur please try again"]);
        }

    }
    public function postreply(Request $request){
//        dd($request->user_id);
        $reply = new  PostComment();

        $reply->comment = $request->get('comment');

        $reply->user()->associate($request->user());

        $reply->parent_id = $request->get('comment_id');
//        dd($request->get('user_id'));
        $post = Post::find($request->get('post_id'));
        $action="reply";
        if($post->comments()->save($reply)){
            if(Auth::user()->id != $request->user_id){
                $notification = Notification::create([
                    'user_id' => $request->user_id,
                    'sender_id' => Auth::user()->id,
                    'receiver_id' => $request->user_id,
                    'notification_about' => 'replied on the post you commented',
                    'about_id'=>$post->id,
                    'status' => '0',
                ]);
                $message='replied on the post you commented';
//            event(new App\Events\FriendRequestNotification('Someone'));
                event(new FriendRequestNotification(Auth::user()->name,$request->user_id,$message));
            }
            event(new Comment(Auth::user()->name,$request->post_id,$request->comment,$action,$request->comment_id,$request->user_id,));
            return response()->json(['response'=>'Comment Replied Successfully']);

        }else{
            return response()->json(['error'=>" Some Error occur please try again"]);
        }
    }
}
