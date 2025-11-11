<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = $request->only(['name', 'email', 'password']);
        $user['password'] = Hash::make($user['password']);
        User::create($user);
        return view('auth.login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return redirect('/login')->withErrors([
                'email' => 'ログイン情報が登録されていません',
            ])->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return redirect('/login')->withErrors([
                'password' => 'パスワードに誤りがあります。',
            ])->withInput();
        }

        return redirect('/admin');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
