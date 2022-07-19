<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { $friends = FriendRequest::where('user_id', '=', Auth::user()->id)->pluck('friend_id')->toArray();
     $friendswith = FriendRequest::where('friend_id', '=', Auth::user()->id)->pluck('user_id')->toArray();
//        $notifications=Notification::where('user_id', '=', Auth::id())->orwhere('receiver_id', '=', Auth::id())->get();
//    foreach ($friends as $friend)
        $friendsposts = FriendRequest::where('user_id', '=', Auth::user()->id)->where('status',1)->pluck('friend_id')->toArray();
        $friendsuserposts = FriendRequest::where('friend_id', '=', Auth::user()->id)->where('status',1)->pluck('user_id')->toArray();
        $post=Post::whereIn('user_id', [Auth::user()->id])->orwhereIn('user_id',$friendsuserposts)->orwhereIn('user_id',$friendsposts)->orderBy('id', 'DESC')->get();
//        dd($post);
        //        dd($post);
//        foreach ($post as $posts){
//            for($i=0;$i<count($posts->postFile);$i++){
////            dd($posts->postFile[$i]->file_url);
//                if($posts->id == $posts->postFile[$i]->id)
//                    echo "Count Number".$i;
//                echo $posts->postFile[$i]->file_url;
//            }
//        $postImages=$posts->postFile;
//        }
//dd($postImages);
        $notfriends = User::whereNotIn('id', $friends)->whereNotIn('id', $friendswith)->whereNotIn('id', [Auth::user()->id])->whereIn('email_verified',[1])->get();

        //        dd($notfriends);
//        $notifications=Notification::all();
//        $count=count($notifications);
//        dd($notifications);


        return view('index',['friend_requests' => $notfriends,'posts'=>$post]);
    }
    public function timeline()
    {
        $friendsarray = FriendRequest::where('user_id', '=', Auth::user()->id)->pluck('friend_id')->toArray();
        $friendswith = FriendRequest::where('friend_id', '=', Auth::user()->id)->pluck('user_id')->toArray();
        $notfriends = User::whereNotIn('id', $friendsarray)->whereNotIn('id', $friendswith)->whereNotIn('id', [Auth::user()->id])->whereIn('email_verified',[1])->get();

//        $friendposts = FriendRequest::where('user_id', '=', Auth::user()->id)->where('status',1)->pluck('friend_id')->toArray();
//        $friendsuserposts = FriendRequest::where('friend_id', '=', Auth::user()->id)->where('status',1)->pluck('user_id')->toArray();
        $post=Post::whereIn('user_id', [Auth::user()->id])->get();
//        dd($post);

        return view('timeline',['friend_requests' => $notfriends,'posts'=>$post]);
    }
    public function about()
    {
        $friendsarray = FriendRequest::where('user_id', '=', Auth::user()->id)->pluck('friend_id')->toArray();
        $friendswith = FriendRequest::where('friend_id', '=', Auth::user()->id)->pluck('user_id')->toArray();
        $notfriends = User::whereNotIn('id', $friendsarray)->whereNotIn('id', $friendswith)->whereNotIn('id', [Auth::user()->id])->whereIn('email_verified',[1])->get();

        return view('about',['friend_requests' => $notfriends]);
    }
    public function timelinefriends()
    {
        $request = FriendRequest::where('friend_id', '=', Auth::user()->id)->where('status','=',0)->get();
        $friends = FriendRequest::where('user_id', '=', Auth::user()->id)->orwhere('friend_id', '=', Auth::user()->id)->where('status','=',1)->get();
        $requests_counts=count($request);
        $friends_counts=count($friends);
        $friendsarray = FriendRequest::where('user_id', '=', Auth::user()->id)->pluck('friend_id')->toArray();
        $friendswith = FriendRequest::where('friend_id', '=', Auth::user()->id)->pluck('user_id')->toArray();
        $notfriends = User::whereNotIn('id', $friendsarray)->whereNotIn('id', $friendswith)->whereNotIn('id', [Auth::user()->id])->whereIn('email_verified',[1])->get();

//        dd($friends);
//        dd($request);
//        $friends_request = User::whereIn('id', $request)->whereIn('email_verified',[1])->get();
//        $user= (new \App\Models\FriendRequest)->user();
//        dd($user);
        return view('timelinefriends',['requested_friends' => $request,'count' =>$requests_counts,'friends'=>$friends,'friends_counts'=>$friends_counts,'friend_requests' => $notfriends]);
    }
    public function timelinephotos()
    {
        $userpost=Post::where('user_id',Auth::user()->id)->get();

        return view('timelinephotos',['posts'=>$userpost]);
    }
    public function timelinevideos()
    {
        return view('timelinevideos');
    }
    public function singlepost($post){
        $post_data=Post::find($post);
//                dd($post_data);
        $friends = FriendRequest::where('user_id', '=', Auth::user()->id)->pluck('friend_id')->toArray();
        $friendswith = FriendRequest::where('friend_id', '=', Auth::user()->id)->pluck('user_id')->toArray();
        $notfriends = User::whereNotIn('id', $friends)->whereNotIn('id', $friendswith)->whereNotIn('id', [Auth::user()->id])->whereIn('email_verified',[1])->get();


        return view('singlepost',['post'=>$post_data,'friend_requests' => $notfriends]);
    }

    public function model(){
//        $logincount=User::where('id',Auth::user()->id)->where('login_count',0)->get();
//        if ($logincount){
//            return response()->json(['response'=>'User is logged in for the first time']);
//        }else{
//            return response()->json(['error'=>'User is not logged in for the first time']);
//        }
        return view('model');
    }
    public function profile($id){
        $id=decrypt($id);
        $user=User::find($id);

        $post=Post::whereIn('user_id', [$id])->get();
        $friends = FriendRequest::where('user_id', '=', Auth::user()->id)->pluck('friend_id')->toArray();
        $friendswith = FriendRequest::where('friend_id', '=', Auth::user()->id)->pluck('user_id')->toArray();
        $notfriends = User::whereNotIn('id', $friends)->whereNotIn('id', $friendswith)->whereNotIn('id', [Auth::user()->id])->whereIn('email_verified',[1])->get();

        $userfriend = FriendRequest::where('user_id', '=', Auth::user()->id )->where('friend_id', '=', $id)->where('status','=',1)->get();
        $friendwithuser = FriendRequest::where('user_id', '=', $id )->where('friend_id', '=', Auth::user()->id)->where('status','=',1)->get();
//        dd($userfriend);
        if(count($userfriend) >0 or count($friendwithuser)>0){
            $check='is_friend';
        }else{
            $check='not_friend';
        }
        return view('profile',['User'=>$user,'friend_requests' => $notfriends,'posts'=>$post,'check'=>$check]);
    }
    public function profilephotos($id){
        $id=decrypt($id);
        $userpost=Post::where('user_id',$id)->get();
        $user=User::find($id);

        $userfriend = FriendRequest::where('user_id', '=', Auth::user()->id )->where('friend_id', '=', $id)->where('status','=',1)->get();
        $friendwithuser = FriendRequest::where('user_id', '=', $id )->where('friend_id', '=', Auth::user()->id)->where('status','=',1)->get();
//        dd($userfriend);
        if(count($userfriend) >0 or count($friendwithuser)>0){
            $check='is_friend';
        }else{
            $check='not_friend';
        }
        return view('profilephotos',['posts'=>$userpost,'User'=>$user,'check'=>$check]);
    }
    public function profilevideos($id){
        $id=decrypt($id);
        $user=User::find($id);
        $userfriend = FriendRequest::where('user_id', '=', Auth::user()->id )->where('friend_id', '=', $id)->where('status','=',1)->get();
        $friendwithuser = FriendRequest::where('user_id', '=', $id )->where('friend_id', '=', Auth::user()->id)->where('status','=',1)->get();
//        dd($userfriend);
        if(count($userfriend) >0 or count($friendwithuser)>0){
            $check='is_friend';
        }else{
            $check='not_friend';
        }
        return view('profilevideos',['User'=>$user,'check'=>$check]);
    }
    public function profilefriends($id){
        $id=decrypt($id);
        $user=User::find($id);

        $request = FriendRequest::where('friend_id', '=', $id)->where('status','=',0)->get();
        $friends = FriendRequest::where('user_id', '=', $id)->orwhere('friend_id', '=', $id)->where('status','=',1)->get();
        $requests_counts=count($request);
        $friends_counts=count($friends);
        $friendsarray = FriendRequest::where('user_id', '=', $id)->pluck('friend_id')->toArray();
        $friendswith = FriendRequest::where('friend_id', '=', $id)->pluck('user_id')->toArray();
        $notfriends = User::whereNotIn('id', $friendsarray)->whereNotIn('id', $friendswith)->whereNotIn('id', [$id])->whereIn('email_verified',[1])->get();

        $userfriend = FriendRequest::where('user_id', '=', Auth::user()->id )->where('friend_id', '=', $id)->where('status','=',1)->get();
        $friendwithuser = FriendRequest::where('user_id', '=', $id )->where('friend_id', '=', Auth::user()->id)->where('status','=',1)->get();
//        dd($userfriend);
        if(count($userfriend) >0 or count($friendwithuser)>0){
            $check='is_friend';
        }else{
            $check='not_friend';
        }

        return view('profilefriends',['User'=>$user,'requested_friends' => $request,'count' =>$requests_counts,'friends'=>$friends,'friends_counts'=>$friends_counts,'friend_requests' => $notfriends,'check'=>$check]);
    }
    public function profileabout($id){
        $id=decrypt($id);
        $user=User::find($id);

        $userfriend = FriendRequest::where('user_id', '=', Auth::user()->id )->where('friend_id', '=', $id)->where('status','=',1)->get();
        $friendwithuser = FriendRequest::where('user_id', '=', $id )->where('friend_id', '=', Auth::user()->id)->where('status','=',1)->get();
//        dd($userfriend);
        if(count($userfriend) >0 or count($friendwithuser)>0){
            $check='is_friend';
        }else{
            $check='not_friend';
        }

        $friendsarray = FriendRequest::where('user_id', '=', $id)->pluck('friend_id')->toArray();
        $friendswith = FriendRequest::where('friend_id', '=', $id)->pluck('user_id')->toArray();
        $notfriends = User::whereNotIn('id', $friendsarray)->whereNotIn('id', $friendswith)->whereNotIn('id', [$id])->whereIn('email_verified',[1])->get();

        return view('profileabout',['User'=>$user,'friend_requests' => $notfriends,'check'=>$check]);
    }
}
