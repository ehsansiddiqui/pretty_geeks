<?php

namespace App\Http\Controllers;

use App\Events\FriendRequestNotification;
use App\Models\Friend;
use App\Models\Notification;
use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FriendRequestController extends Controller
{
    //
    public function friendrequest(Request $request){
//        dd($request->name);
//        $validator = Validator::make($request->all(), [
//            'friend_id' => 'exists:friend_id'
//        ]);
//        dd($request->id);
        $friends = FriendRequest::where('user_id', '=', Auth::user()->id)->where('friend_id', '=', $request->id)->get();
//        dd($friends);
        if (count($friends)>0) {
//                return back()
//                    ->withErrors($validator)
//                    ->withInput();
            return response()->json(['error'=>"Already Added as Friends"]);
        }
        $friendrequest = FriendRequest::create([
            'user_id' => Auth::user()->id,
            'friend_id' => $request->id,
            'status' => '0',
        ]);
        if($friendrequest){
            $notification = Notification::create([
                'user_id' => Auth::user()->id,
                'sender_id' => Auth::user()->id,
                'receiver_id' => $request->id,
                'notification_about' => 'You Sent Friend Request',
                'about_id'=>$friendrequest->id,
                'status' => '0',
            ]);
            $notification = Notification::create([
                'user_id' => $request->id,
                'sender_id' => $request->id,
                'receiver_id' => Auth::user()->id,
                'notification_about' => 'Sent You Friend Request',
                'about_id'=>$friendrequest->id,
                'status' => '0',
            ]);
            $message='Sent you a Friend Request';
//            event(new App\Events\FriendRequestNotification('Someone'));
            event(new FriendRequestNotification(Auth::user()->name,$request->id,$message));
            return response()->json(['response'=>" Friend Request Sent to $request->name Successfully"]);
        }else{
            return response()->json(['response'=>"Some Error occur please try again"]);
        }
    }
    public function acceptfriendrequest(Request $request){

//        dd($request);
        $friendrequest=FriendRequest::find($request->id);
        $notification=Notification::where('about_id', $request->id)->where('receiver_id', Auth::user()->id)->first();
        $notificationto=Notification::where('about_id', $request->id)->where('sender_id', Auth::user()->id)->first();
//        dd($notificationto);
        if($friendrequest){
            $friendrequest->status=1;
            $friendrequest->save();
            $notification->notification_about='Accepted Your Friend Request';
            $notification->save();
            $notificationto->notification_about='You Accepted his Friend Request';
            $notificationto->save();
//            $friends = Friend::create([
//                'user_id' => Auth::user()->id,
//                'friend_id' => $request->id,
//            ]);
//            $addnotification = Notification::create([
//                'user_id' => Auth::user()->id,
//                'sender_id' => Auth::user()->id,
//                'receiver_id'=>$notification->sender_id,
//                'notification_about'=>'You Accepted his Friend Request',
//                'about_id'=>$request->id,
//            ]);
            return response()->json(['response'=>"Friend Requested Accepted"]);
        }else{
            return response()->json(['error'=>" Some Error occur please try again"]);
        }
//        dd($friendrequest);
    }
    public function rejectfriendrequest(Request $request){

        $friendrequest=FriendRequest::find($request->id);
//        $notification=Notification::find($request->id);
        $notification = Notification::where('about_id', $request->id)->delete();
//                dd($request);

        if($friendrequest->delete()){
            return response()->json(['response'=>"Friend Requested Rejected"]);
        }else{
            return response()->json(['error'=>" Some Error occur please try again"]);
        }
//        dd($friendrequest);
    }
    public function unfriend(Request $request){
//        dd($request);
        $friendrequest=FriendRequest::find($request->id);
//        $notification=Notification::find($request->id);
        $notification = Notification::where('about_id', $request->id)->delete();
//                dd($request);

        if($friendrequest->delete()){
            return response()->json(['response'=>"UnFriend Successfully"]);
        }else{
            return response()->json(['error'=>" Some Error occur please try again"]);
        }
//        dd($friendrequest);
    }
}
