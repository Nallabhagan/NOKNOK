<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Vinkla\Hashids\Facades\Hashids;

class SocilMediaAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

  
    public function handleProviderCallback()
    {
        $userGmail = Socialite::driver('google')->stateless()->user();
        $emailId = $userGmail->getEmail();
        $findUser = User::where(['email' => $emailId])->first();
        if($findUser){
           
            
            if(!session()->has('url.intended'))
            {
                session(['url.intended' => url()->previous()]);
            }
            
            Auth::login($findUser);
            $home_url = url('/').'/';
            $session_url = session('url.intended');
    
            if($home_url === $session_url) { 
                return redirect('/user/' . Hashids::connection('user')->encode($findUser->id));
            } else {
                return redirect(session('url.intended'));
            }
            // return redirect(session('url.intended'));
        }else{
            $date = Carbon::now();
            $user = new User;
            $user->name = $userGmail->getName();
            $user->email = $userGmail->getEmail();
            $user->email_verified_at =  $date->format('Y-m-d H:i:s');
            $user->password = bcrypt(12345678);
            $user->profile_pic  = $userGmail->getAvatar();
            $user->registration_type = "Google_Signin";
            $user->save();
            
            
            if(!session()->has('url.intended'))
            {
                session(['url.intended' => url()->previous()]);
            }
            
            
            Auth::login($user);
            $home_url = url('/').'/';
            $session_url = session('url.intended');
    
            if($home_url === $session_url) { 
                return redirect('/user/' . Hashids::connection('user')->encode($user->id));
            } else {
                return redirect(session('url.intended'));
            }
            // return redirect(session('url.intended'));
        }
    }


    public function redirectToFbProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFbProviderCallback()
    {
        
        $userGmail = Socialite::driver('facebook')->stateless()->user();
        $emailId = "";
        if($userGmail->getEmail() == null)
        {
            $emailId = $userGmail->getName();
        } else {
            $emailId = $userGmail->getEmail();
        }
        $findUser = User::where(['email' => $emailId])->first();
        if($findUser){
           
            
            if(!session()->has('url.intended'))
            {
                session(['url.intended' => url()->previous()]);
            }
            
            Auth::login($findUser);
            $home_url = url('/').'/';
            $session_url = session('url.intended');
    
            if($home_url === $session_url) { 
                return redirect('/user/' . Hashids::connection('user')->encode($findUser->id));
            } else {
                return redirect(session('url.intended'));
            }
            // return redirect(session('url.intended'));
        }else{
            $date = Carbon::now();
            $user = new User;
            $user->name = $userGmail->getName();
            $user->email = $emailId;
            $user->email_verified_at =  $date->format('Y-m-d H:i:s');
            $user->password = bcrypt(12345678);
            $user->profile_pic  = $userGmail->getAvatar();
            $user->registration_type = "Facebook_Signin";
            $user->save();
            
            
            if(!session()->has('url.intended'))
            {
                session(['url.intended' => url()->previous()]);
            }
            Auth::login($user);
            $home_url = url('/').'/';
            $session_url = session('url.intended');
    
            if($home_url === $session_url) { 
                return redirect('/user/' . Hashids::connection('user')->encode($user->id));
            } else {
                return redirect(session('url.intended'));
            }

            // return redirect(session('url.intended'));
        }
        
    }
}
