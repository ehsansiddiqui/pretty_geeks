<?php

namespace App\Http\Controllers;

use App\Events\FriendRequestNotification;
use App\Models\Notification;
use App\Models\Post;
use App\Models\PostsFile;
use App\Models\PostsImages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller{
    public function insertposts (Request $request) {

//            if ($request->file('image')->isValid()) {
//                //
//                $validated = $request->validate([
//                    'description' => 'string|max:100',
//                    'image' => 'mimes:jpeg,png|max:1014',
//                ]);
//
//        dd(Auth::user());
        $post = Post::create([
            'user_id' => Auth::user()->id,
            'description' => $request['description'],

        ]);
//        $count=count($request->image_url);
//        $images=$request->image_url;
//        for($i=0; $i<$count;$i++) {
//            $file = $images[$i];
//            $uploadImage=new PostsImages();
//            if ($request->hasFile('image_url')) {
//                $name = time() . '_' . $file->getClientOriginalName();
//                $file->storeAs('images', $name);
//                $postImage = PostsImages::create([
//                    'post_id' => $post->id,
//                    'image_url' => $name,
//
//                ]);
////                return response()->json(['response'=>'Image Uploaded Successfully']);
//            }else{
//                return response()->json(['response'=>'some error occurs please try again']);
//            }
//        }
//        $image_path = 'service/transportation/carRental';
        if ($request->hasFile('file_url')) {
            foreach ($request->file('file_url') as $file){
                $name=time().'_'.$file->getClientOriginalName();
                $path=$file->storeAs('images', $name);
//                $image_resize = Image::make($image->getRealPath());
//                $image_resize->resize(300, 300);
//                $image_resize->save(public_path('images/ServiceImages/' .$filename));
//                $path = public_path(). '/images/';
//                dd($path);
////                $data[]=$name;
//                dd($path);
                $postFile = PostsFile::create([
                    'post_id' => $post->id,
                    'file_url' => $path,

                ]);
            }
//            return response()->json(['response'=>'Image Uploaded Successfully']);
        }else{
            return response()->json(['response'=>'some error occurs please try again']);
        }
        return response()->json(['response'=>'Post Uploaded Successfully']);

    }
    public function sharepost(Request $request){
//        dd($request->post['user_id']);
        if(Auth::user()->id != $request->post['user_id']){


        $post = Post::create([
            'user_id' => Auth::user()->id,
            'description' => $request->post['description'],

        ]);

//        if ($request->hasFile('file_url')) {
            foreach ($request->post_images as $file){
//                $name=time().'_'.$file->getClientOriginalName();
//                $path=$file->storeAs('images', $name);
//                $image_resize = Image::make($image->getRealPath());
//                $image_resize->resize(300, 300);
//                $image_resize->save(public_path('images/ServiceImages/' .$filename));
//                $path = public_path(). '/images/';
//                dd($path);
////                $data[]=$name;
//                dd($path);
                $postFile = PostsFile::create([
                    'post_id' => $post->id,
                    'file_url' => $file['file_url'],

                ]);
            }
            $notification = Notification::create([
                'user_id' => $request->post['user_id'],
                'sender_id' => Auth::user()->id,
                'receiver_id' => $request->post['user_id'],
                'notification_about' => 'Shared your post',
                'about_id'=>$request->post['id'],
                'status' => '0',
            ]);
            $message='Shared your post';
//            event(new App\Events\FriendRequestNotification('Someone'));
            event(new FriendRequestNotification(Auth::user()->name,$request->post['user_id'],$message));
//            return response()->json(['response'=>'Image Uploaded Successfully']);
//        }else{
//            return response()->json(['response'=>'some error occurs please try again']);
//        }
        return response()->json(['response'=>'Post Share Successfully']);
        }else{
            return response()->json(['error'=>'You cannot share your own post']);
        }
    }
    public function publishtofacebook(Request $request){

    }
    public function postavatar(Request $request){


        if ($request->hasFile('avatar') and $request->hasFile('avatar_cover')) {
//            dd($request['education']);
                $avatar=$request->file('avatar');
                $name=time().'_'.$avatar->getClientOriginalName();
                $path=$avatar->storeAs('images', $name);

                $avatar_cover=$request->file('avatar_cover');
                $name_avatar_cover=time().'_'.$avatar_cover->getClientOriginalName();
                $path_avatar_cover=$avatar_cover->storeAs('images', $name_avatar_cover);
//                $image_resize = Image::make($image->getRealPath());
//                $image_resize->resize(300, 300);
//                $image_resize->save(public_path('images/ServiceImages/' .$filename));
//                $path = public_path(). '/images/';

                $user=User::find(Auth::user()->id);
//                dd($user);
                $user->avatar=$path;
                $user->cover_avatar=$path_avatar_cover;
                $user->interested_in=$request['interested_in'];
                $user->martial_status=$request['martial_status'];
                $user->profession=$request['profession'];
                $user->company_name=$request['company_name'];
                $user->profession_title=$request['profession_title'];
                $user->profession_start_date=$request['profession_start_date'];
                $user->profession_end_date=$request['profession_end_date'];
                $user->education=$request['education'];
                $user->university_name=$request['university_name'];
                $user->education_start_date=$request['education_start_date'];
                $user->education_end_date=$request['education_end_date'];

                $user->login_count=1;
                $user->save();
//            }
            return response()->json(['response'=>'Image Uploaded Successfully']);
        }else{
            return response()->json(['response'=>'some error occurs please try again']);
        }
    }
    public function changedp(Request $request){
        if($request->hasFile('avatar')){
            $avatar=$request->file('avatar');
            $name=time().'_'.$avatar->getClientOriginalName();
            $path=$avatar->storeAs('images', $name);

            $thumbnailpath = public_path('storage/images/'.$name);
//            dd($thumbnailpath);
            $img = Image::make($thumbnailpath)->resize(400, 400, function($constraint) {
//                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $user=User::find(Auth::user()->id);
//                dd($user);
            $user->avatar=$path;

            if($user->save()){
                return response()->json(['response'=>'Profile Image changed Successfully']);

            }else{
                return response()->json(['response'=>'Some error occured']);
            }
//            return response()->json(['response'=>'Please Uploadsuccess']);
        }else{
            return response()->json(['response'=>'Please Upload Image']);

        }
    }

    public function changecover(Request $request){
        if($request->hasFile('cover_avatar')){
            $cover_avatar=$request->file('cover_avatar');
            $name=time().'_'.$cover_avatar->getClientOriginalName();
            $path=$cover_avatar->storeAs('images', $name);

            $thumbnailpath = public_path('storage/images/'.$name);
//            dd($thumbnailpath);
            $img = Image::make($thumbnailpath)->resize(1190, 380, function($constraint) {
//                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $user=User::find(Auth::user()->id);
//                dd($user);
            $user->cover_avatar=$path;

            if($user->save()){
                return response()->json(['response'=>'Cover Image changed Successfully']);

            }else{
                return response()->json(['response'=>'Some error occured']);
            }
//            return response()->json(['response'=>'Please Uploadsuccess']);
        }else{
            return response()->json(['response'=>'Please Upload Image']);

        }
    }
}
