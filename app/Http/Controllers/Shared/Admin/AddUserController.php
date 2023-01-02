<?php

namespace App\Http\Controllers\Shared\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Configuration;
use App\Models\User;
use App\Models\VgApplications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AddUserController extends Controller
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
        return view("Shared.Admin.add-user");
    }

    public function Post(Request $request)
    {
            $password = Hash::make($request->input('cell'));
            $user = User::firstOrNew(['email' => $request->input('username')]);
            $user->password = $password;
            $user->name = $request->input('name');
            $user->cell = $request->input('cell');
            $user->role = $request->input('role');
            $user->cid = $request->input('cid');
            $user->steamId = $request->input('steamId');
            $user->disabled = 0;
            if ($request->role == "Boss" || $request->role == "Manager") {
                $user->isAdmin = 1;
            } else {
                $user->isAdmin = 0;
            }

            $user->save();


            return back()->with('message', "User Created/Updated");
    }
}
