<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\User;

class AdminAuthController extends Controller
{
    /**
     * Tampilkan halaman login admin.
     */
    public function showLogin()
    {
        // Kalau sudah login sebagai admin, langsung ke dashboard
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Proses login admin dengan rate-limiting.
     * Maksimal 5 percobaan per menit per IP.
     */
    public function login(Request $request)
    {
        // Rate limiting: max 5 attempts per minute per IP
        $throttleKey = 'admin-login:' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            \Log::warning('Admin login rate limit exceeded.', [
                'ip' => $request->ip(),
                'remaining_seconds' => $seconds,
            ]);

            return back()->with('lockout',
                "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik."
            );
        }

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        // Cek apakah user ada DAN merupakan admin
        if (!$user || !$user->is_admin) {
            RateLimiter::hit($throttleKey, 60); // decay 60 detik

            \Log::warning('Failed admin login attempt.', [
                'username' => $request->username,
                'ip' => $request->ip(),
                'reason' => !$user ? 'user_not_found' : 'not_admin',
            ]);

            // Respons generik agar attacker tidak bisa enumerasi username
            return back()->with('error', 'Kredensial tidak valid.');
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);

            \Log::warning('Failed admin login - wrong password.', [
                'username' => $request->username,
                'ip' => $request->ip(),
            ]);

            return back()->with('error', 'Kredensial tidak valid.');
        }

        // Login berhasil — reset rate limiter
        RateLimiter::clear($throttleKey);

        Auth::login($user);
        $request->session()->regenerate();

        \Log::info('Admin login successful.', [
            'user_id' => $user->id_user,
            'username' => $user->username,
            'ip' => $request->ip(),
        ]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        \Log::info('Admin logged out.', [
            'user_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Berhasil logout.');
    }
}
