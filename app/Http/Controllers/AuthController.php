<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // FORM LOGIN
    public function login()
    {
        return view('login');
    }

    // PROSES LOGIN
    public function loginPost(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        }

        return back()->with('error','Email atau password salah');
    }

    // FORM REGISTER
    public function register()
    {
        return view('register');
    }

    // PROSES REGISTER
    public function registerPost(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect('/login')->with('success','Berhasil daftar');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}