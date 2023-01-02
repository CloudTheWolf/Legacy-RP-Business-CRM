<?php

namespace App\Http\Controllers\Shared\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Configuration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DisabledUsersController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->IsAdmin == 1) return $next($request);
            abort('401', "You don't have access to this page");
        });
    }

    public function Get()
    {
        $users = User::whereDisabled("1")->get();
        return view("Shared.disabledUsers",compact("users"));
    }


}
