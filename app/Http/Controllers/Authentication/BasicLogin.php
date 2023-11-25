<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasicLogin extends Controller
{
    public function Get(Request $request)
    {
        if (Auth::check()) {
            return redirect(url('/dashboard'));
        }
        return view("auth.login",compact("request"));
    }

    public function Post(Request $request)
    {
        $credentials = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        );

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            if (Auth::user()->disabled == 1)
            {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with("error","Account Disabled");
            }
            return redirect()->intended('/');
        } else {
            return back()->with(
                'error', 'The provided credentials do not match our records.',
            );
        }


    }

}
