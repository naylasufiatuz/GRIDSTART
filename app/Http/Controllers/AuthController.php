<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ── REGISTER ──
    public function showSignon()
    {
        return view('signon');
    }

    public function signon(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ], [
            'username.unique' => 'Username sudah digunakan, coba yang lain.',
            'email.unique'    => 'Email sudah terdaftar.',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->intended(route('app'))->with('success', 'Akun berhasil dibuat!');
    }

    // ── LOGIN ──
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Username belum terdaftar.');
        }

        // Cek admin
        if ($user->username === 'admin') {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            } else {
                return back()->with('error', 'Password tidak cocok.');
            }
        }

        // Login user biasa
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('app'))->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Password tidak cocok.');
    }

    // ── LOGOUT ──
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    // ── UPDATE PROFILE ──
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:5',
        ], [
            'username.unique' => 'Username sudah digunakan, coba yang lain.',
            'password.min'    => 'Password minimal harus 5 karakter.',
        ]);

        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}