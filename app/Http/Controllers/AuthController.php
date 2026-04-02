<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showSignon()
    {
        return view('signon');
    }



public function signon(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:5|confirmed',
    ]);

    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    Auth::login($user); // login otomatis setelah register

    return redirect()->route('app')->with('success', 'Akun berhasil dibuat!');
}
        
    
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

    if (auth()->attempt(['username' => $request->username, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect()->route('app')->with('success', 'Login berhasil!');
    }

    return back()->withErrors(['username' => 'Username atau password salah.']);
}



    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout berhasil!');
    }
}