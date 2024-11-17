<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SocialController extends Controller
{
     public function redirectToGoogle()
     {
         return Socialite::driver('google')->redirect();
     }

     public function googleCallback()
     {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'avatar' => $googleUser->getAvatar(),
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole('user');

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

