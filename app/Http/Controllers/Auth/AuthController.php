<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirectToProvider($provider) 
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider) 
    {
        $user = Socialite::driver($provider)->user();
        $email = $user->getEmail();
        $checkUser = User::where('email', $email)->first();
        if (empty($checkUser)) {
            $createdUser = User::create([
                'name' => $user->nickname,
                'email' => $user->getEmail(),
                'password' => '',
            ]);
            Auth::login($createdUser);

            return redirect()->route('home');
        };
        Auth::login($checkUser);

        return redirect()->route('home');
    }
}
