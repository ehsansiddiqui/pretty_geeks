<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use function GuzzleHttp\Promise\all;


class AuthController extends Controller{
        private $user;
        public $successStatus = 200;
        public function __construct(User $user)
        {
//            $this->middleware('auth');
            $this->user = $user;
        }

        public function register(Request $request){
//        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'mobile_number' => 'required|regex:/(03)[0-9]{9}/',
                'sex' => 'required|string|max:255',
                'dob' => 'required|date',
            ]);
            if ($validator->fails()) {
//                return back()
//                    ->withErrors($validator)
//                    ->withInput();
                return response()->json(['error'=>$validator->errors()]);
            }
            $token = bin2hex(random_bytes(20));

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'mobile_number' => $request['mobile_number'],
                'sex' => $request['sex'],
                'dob' => $request['dob'],
                'verified_token' => $token,
                'status' => '1',
            ]);
            $data = array(
//                'link' => route('verifyEmail' , $token),
                'link' => url('/verify-email/'.$token),
                'email' => $user->email,
            );
            Mail::send('mail.mail', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject('Email Verification');
            });

        //    $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['response'=>"Please Check your Email for verification"]);
//            return response()->json(['url'=>url('/')]);

    }
    public function signin(Request $request){

//        $validator = Validator::make($request->all(), [
//            'email' => 'email|required',
//            'password' => 'required|string|min:6'
//        ]);
//        if ($validator->fails()) {
//            return response()->json(['error'=>$validator->errors()]);
//        }

        $users = $this->user->all();

        $pageVars = [
            //This is the title of my custom view.
//            'pageTitle'=>'Users',
            // The individual user I'm logged in as (So I can say "Hi, Sam" in my template
            'user'=>Auth::user(),
            //My list of users
            'users' => $users
            ];
        $validatedLoginData = Validator::make([

            'email' => $request->email,
            'password' => $request->password
        ], [
            'email' => 'email|required',
            'password' => 'required|string|min:6'
        ]);

//        if(auth()->attempt(array('email' => $request->input('email'),
//            'password' => $request->input('password')),true)) {
//            return response()->json(['url'=>url('/home')]);
//        }else {
//            return response()->json(['error'=>"Login failed! Check your password & username"]);
//        }


        if($validatedLoginData->fails()) {
            return response()->json([
                'isLogged' => false,
                'error' => $validatedLoginData->errors()
            ]);

        } else {

            if(!auth()->attempt($validatedLoginData->valid())) {
                return response()->json([
                    'isLogged' => false,
                    'error' => 'Please check your Credentials'
                ]);

            } else {

//                $accessToken = auth()->user()->createToken('userToken')->accessToken;
//                Auth::login($user);
                return response()->json([
                    'isLogged' => true,
                    'user' => auth()->user(),
                    'url'=>url('/home'),
//                    'url'=> route('home',$pageVars),
//                    'url'=>{{ route('admin.editIndustry', 1) }},
//                    'access_token' => $accessToken
                ]);


            }

        }
    }

    public function verifyEmail($token){
        $user = User::where('verified_token', $token)->first();
        if(!empty($user)){
            $date = date('Y-m-d H:i:s');
            $user->update([
                'email_verified_at'=>$date,
                'verified_token' => null,
                'email_verified' => 1,
            ]);
            return redirect()->route('login-reg')->with('success', 'Email Verified , Login to proceed.');
           // return view('app', ['success' => 'Email Verified , Login to proceed.']);
        }
        else{
            return redirect()->route('login-reg')->with('error', 'Invalid Request');
//            return view('app', ['success' => 'Email Verified , Login to proceed.']);

        }

    }

    public function resetpassword(Request $request){
//            dd($request->all());
        $user=User::whereEmail($request->email)->first();
//        dd($user);
        if(!isset($user)){
            return redirect()->route('forgetpassword')->with('success', 'No User Found for this Email.');
        }else{

            $token = bin2hex(random_bytes(20));

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $data = array(
//                'link' => route('verifyEmail' , $token),
                'link' => url('/reset/'.$token),
                'email' => $user->email,
            );
            Mail::send('mail.resetmail', ["data" => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject('Password Reset');
            });
            return redirect()->route('forgetpassword')->with('success', 'Reset Password Link is send to your Email.');
        }

    }
    public function setnewpassword(Request $request){
//            dd($request->all());
        $validator = Validator::make($request->all(), [

            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password|min:6',
            'token' => 'required'
        ]);
        if ($validator->fails()) {
//                return back()
//                    ->withErrors($validator)
//                    ->withInput();
//            dd($validator->errors());
            return redirect()->back()->withErrors($validator);
//            return response()->json(['error'=>$validator->errors()]);
        }
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();
//        dd($tokenData);
        if(!$tokenData){
            return redirect()->route('forgetpassword');
        }else{
            $user = User::where('email', $tokenData->email)->first();
//            dd($user);
            if (!$user){
                return redirect()->back()->withErrors(['email' => 'Email not found']);
            }else{
//                dd($request->password);
                $user->password = \Hash::make($request->password);
                $user->update();
                DB::table('password_resets')->where('email', $user->email)
                    ->delete();
                $data = array(
                'link' => route('login-reg'),
                    'email' => $user->email,
                );
                Mail::send('mail.resetconfirmation', ["data" => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject('Password Reset Successfully');
                });
                return redirect()->route('login-reg')->with('success', 'Your Password have been reset');

            }
        }

    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();

    }

    public function handleProviderCallback($provider)
    {
//        $guzzle = new Client(['verify' => 'C:\wamp64\bin\php\php7.2.25\extras\ssl\cacert.pem']);
        try {
            $user = Socialite::driver($provider)->user();
//            dd($user);
        } catch (\Exception $e) {
//            dd($e);
            return redirect()->route('registration')->with('error', 'Some error occurs try again');

        }
        // only allow people with @company.com to login
//        if(explode("@", $user->email)[1] !== 'company.com'){
//            return redirect()->to('/');
//        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
//            $newUser                  = new User;
//            $newUser->name            = $user->name;
//            $newUser->username        = $user->username;
//            $newUser->gender          = $user->sex;
//            $newUser->email           = $user->email;
//            $newUser->google_id       = $user->id;
//            $newUser->avatar          = $user->avatar;
//            $newUser->avatar_original = $user->avatar_original;
//            $newUser->save();
            $token = bin2hex(random_bytes(4));
            $username=$user->user['given_name'].$token;
//            dd($username);
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'provider' =>$provider,
                'provider_id'=> $user->id,
                'avatar'=>$user->avatar,
                'status' => '1',
            ]);
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }



}



