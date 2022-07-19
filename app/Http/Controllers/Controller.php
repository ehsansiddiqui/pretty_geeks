<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function registration(){
        if(Auth::check()){
            return redirect()->route('home');
        }else {
            return view('sign-up');
        }
    }
    public function loginin(){
        if(Auth::check()){
            return redirect()->route('home');
        }else{
            return view('sign-in');
        }

    }
    public function forgetpassword(){
        if(Auth::check()){
            return redirect()->route('home');
        }else {
            return view('forgetpassword');
        }
    }
    public function reset($token){
        if(Auth::check()){
            return redirect()->route('home');
        }else {
            return view('resetpassword',['token' => $token]);
        }
    }


}
