<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $remember = isset($request->rememberMe);
        $credentials = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        );

        if (Auth::attempt($credentials,$remember)) {
            $request->session()->regenerate();
            if (Auth::user()->disabled == 1)
                {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return back()->with("error","Account Disabled");
                }
            return redirect()->intended('/index');
        } else {
            return back()->with(
                'error', 'The provided credentials do not match our records.',
            );
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
