<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function github()
    {
        return Socialite::driver('github')->redirect();
    }

    public function github_callback()
    {

        $new_user = Socialite::driver('github')->user();

        $this->add_user_and_login( $new_user );

        return redirect('/');
    }

    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebook_callback()
    {

        $new_user = Socialite::driver('facebook')->user();

        $this->add_user_and_login( $new_user );

        return redirect('/');
    }



    public function twitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function twitter_callback()
    {

        $new_user = Socialite::driver('twitter')->user();

        $this->add_user_and_login( $new_user );

        return redirect('/');
    }


    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {

        $new_user = Socialite::driver('google')->user();

        $this->add_user_and_login( $new_user );

        return redirect('/');
    }
    
    public function add_user_and_login( $new_user )
    {

        $user = User::where('email', $new_user->email)->first();

        if ( ! $user ) {
            
            $user = User::create([
                'name' => $new_user->name,
                'email' => $new_user->email,
                'password' => Hash::make(Str::random(10))
            ]);

        }

        Auth::login($user);
    }
}
