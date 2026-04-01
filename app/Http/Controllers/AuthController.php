<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showSignon()
    {
        return view('signon');
    }

    public function signon(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        User::create([
             'username' => $request->username,
             'email' => $request->email,
             'password' => bcrypt($request->password),
         ]);

        
        return redirect()->route('signon')->with('success', 'Akun berhasil dibuat! Silakan login.');    
        }
        

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Kredensial tidak valid.']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('showLogin')->with('success', 'Logout berhasil!');
    }
}