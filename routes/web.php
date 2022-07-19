<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('sign-in');
//})->name('login-reg');
Route::get('/',  [App\Http\Controllers\Controller::class, 'loginin'])->name('login-reg');
Route::get('/registration',  [App\Http\Controllers\Controller::class, 'registration'])->name('registration');
Route::get('/forgetpassword',  [App\Http\Controllers\Controller::class, 'forgetpassword'])->name('forgetpassword');
Route::get('/reset/{token}',  [App\Http\Controllers\Controller::class, 'reset'])->name('reset');

Auth::routes(['verify'=>true]);
Route::get('/verify-email/{token}', [App\Http\Controllers\AuthController::class, 'verifyEmail'])->name('verifyEmail');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/timeline', [App\Http\Controllers\HomeController::class, 'timeline'])->name('timeline');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/timelinefriends', [App\Http\Controllers\HomeController::class, 'timelinefriends'])->name('timelinefriends');
Route::get('/timelinephotos', [App\Http\Controllers\HomeController::class, 'timelinephotos'])->name('timelinephotos');
Route::get('/timelinevideos', [App\Http\Controllers\HomeController::class, 'timelinevideos'])->name('timelinevideos');
Route::get('/redirect/{provider}', [App\Http\Controllers\AuthController::class, 'redirectToProvider']);
Route::get('/callback/{provider}', [App\Http\Controllers\AuthController::class, 'handleProviderCallback']);
Route::get('/singlepost/{post}', [App\Http\Controllers\HomeController::class, 'singlepost'])->name('single_post');
Route::get('/model', [App\Http\Controllers\HomeController::class, 'model'])->name('model');
Route::get('/profile/{id}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/profilephotos/{id}', [App\Http\Controllers\HomeController::class, 'profilephotos'])->name('profilephotos');
Route::get('/profilevideos/{id}', [App\Http\Controllers\HomeController::class, 'profilevideos'])->name('profilevideos');
Route::get('/profilefriends/{id}', [App\Http\Controllers\HomeController::class, 'profilefriends'])->name('profilefriends');
Route::get('/profileabout/{id}', [App\Http\Controllers\HomeController::class, 'profileabout'])->name('profileabout');

Route::get('friendrequestsend', function () {
    event(new App\Events\FriendRequestNotification('plplsk'));
    return "Event has been sent!";
});

Route::post('/sign-up',  [App\Http\Controllers\AuthController::class, 'register'])->name('sign-up');

Route::post('/sign-in',  [App\Http\Controllers\AuthController::class, 'signin'])->name('sign-in');
Route::post('/resetpassword',  [App\Http\Controllers\AuthController::class, 'resetpassword'])->name('resetpassword');
Route::post('/setnewpassword',  [App\Http\Controllers\AuthController::class, 'setnewpassword'])->name('setnewpassword');
Route::post('/home/insertposts',  [App\Http\Controllers\PostController::class, 'insertposts'])->name('insertposts');
Route::post('/home/friendrequest',  [App\Http\Controllers\FriendRequestController::class, 'friendrequest'])->name('friendrequest');
Route::post('/home/acceptfriendrequest', [App\Http\Controllers\FriendRequestController::class, 'acceptfriendrequest']);
Route::post('/home/rejectfriendrequest', [App\Http\Controllers\FriendRequestController::class, 'rejectfriendrequest']);
Route::post('/home/unfriend', [App\Http\Controllers\FriendRequestController::class, 'unfriend']);
Route::post('/home/likepost', [App\Http\Controllers\PostLikeController::class, 'postlike']);
Route::post('/home/dislikepost', [App\Http\Controllers\DisLikeController::class, 'postdislike']);
Route::post('/home/postcomment', [App\Http\Controllers\CommentController::class, 'postcomment']);
Route::post('/home/postreply', [App\Http\Controllers\CommentController::class, 'postreply']);
Route::post('/home/sharepost', [App\Http\Controllers\PostController::class, 'sharepost']);
Route::post('/home/facebookshare', [App\Http\Controllers\PostController::class, 'publishtofacebook']);
Route::post('/home/postavatar', [App\Http\Controllers\PostController::class, 'postavatar']);
Route::post('/home/changedp', [App\Http\Controllers\PostController::class, 'changedp'])->name('changedp');
Route::post('/home/changecover', [App\Http\Controllers\PostController::class, 'changecover'])->name('changecover');
//todo
Route::post('/home/notifications', [App\Http\Controllers\NotificationController::class, 'notification']);

Route::post('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return \redirect()->route('login-reg');
})->name('logout');

Route::get('/clear', function(Request $request) {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    return "Cache is cleared";});
