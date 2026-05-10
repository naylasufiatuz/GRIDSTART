<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::updateOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'username'    => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar'      => $socialUser->getAvatar(),
                    'password'    => bcrypt(Str::random(24)),
                ]
            );

            Auth::login($user);

            return redirect('/app');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', $e->getMessage());
        }
    }
}