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
        if ($provider !== 'google') {
            abort(404);
        }

        $driver = Socialite::driver($provider)->stateless();
        if (config('app.env') === 'local') {
            $driver->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));
        }
        return $driver->redirect();
    }

    public function callback($provider)
    {
        if ($provider !== 'google') {
            abort(404);
        }

        try {
            $driver = Socialite::driver($provider)->stateless();
            if (config('app.env') === 'local') {
                $driver->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));
            }
            $socialUser = $driver->user();

            $email = $socialUser->getEmail() ?? ($socialUser->getId() . '@' . $provider . '.com');

            $user = User::where('email', $email)->first();

            if (!$user) {
                // Determine a unique username
                $baseUsername = $socialUser->getName() ?? $socialUser->getNickname() ?? 'User';
                $username = $baseUsername;
                $counter = 1;
                while (User::where('username', $username)->exists()) {
                    $username = $baseUsername . $counter;
                    $counter++;
                }

                $user = User::create([
                    'username'    => $username,
                    'email'       => $email,
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar'      => $socialUser->getAvatar(),
                    'password'    => bcrypt(Str::random(24)),
                ]);
            } else {
                // Update their social details if logged in via social auth
                $user->update([
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar'      => $socialUser->getAvatar() ?? $user->avatar,
                ]);
            }

            Auth::login($user);
            request()->session()->regenerate();

            return redirect('/app')->with('success', 'Login dengan Google berhasil!');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', $e->getMessage());
        }
    }
}