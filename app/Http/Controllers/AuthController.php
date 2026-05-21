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

        // Cek admin
        $adminUser = User::where('username', 'admin')->first();

        if ($adminUser && $request->username === 'admin' && Hash::check($request->password, $adminUser->password)) {
            Auth::login($adminUser);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Login user biasa
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('app'))->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    // ── LOGOUT ──
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}