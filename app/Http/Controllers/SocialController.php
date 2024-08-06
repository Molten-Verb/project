<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
     public function redirectToGoogle()
     {
         return Socialite::driver('google')->redirect();
     }
     
     public function googleCallback()
     {
        $user = Socialite::driver('google')->user();
        dd($user);
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        $password = Hash::make('12345678');

        $data = [
            'name' => $name, 
            'email' => $email,
            'password' => $password,
            'avatar' => $avatar
        ];
    
        $findUser = User::where('email', $email)->first();
        if($findUser) {
            return $findUser->fill(['name' => $name, 'avatar' => $avatar]);
        }else{
            return User::create($data);
        }        

        return redirect(RouteServiceProvider::HOME);
     }
}
