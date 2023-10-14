<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionToggleController extends Controller
{
    public function setSession(Request $request)
    {
        // Set the session value
        $request->session()->put("LiveMode", $request->input('session_value'));

        // Redirect back to the original page
        return redirect()->back();
    }
}
