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

        // Blokir admin login dari halaman user biasa
        if ($user->is_admin) {
            return back()->with('error', 'Akses tidak valid.');
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

        $changed = false;

        if ($request->username !== $user->username) {
            $user->username = $request->username;
            $changed = true;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $changed = true;
        }

        if (!$changed) {
            return back()->with('info', 'Tidak ada perubahan yang dilakukan.');
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}