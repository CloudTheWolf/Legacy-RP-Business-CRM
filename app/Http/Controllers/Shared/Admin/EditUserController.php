<?php

namespace App\Http\Controllers\Shared\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EditUserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->IsAdmin == 1) return $next($request);
            abort('401', "You don't have access to this page");
        });
    }

    public function Get(Request $request, $id)
    {
        $user = User::whereId($id)->first();

        return view('Shared.Admin.edit-user',compact('user'));
    }

    public function Post(Request $request,$id)
    {
        $admin = $request->input('isAdmin') == 1 ? 1 : 0;
        $disabled = $request->input('disabled') == 1 ? 1 : 0;

        $user = User::whereId($id)->first();
        $user->name = $request->get("name");
        $user->email = $request->get('username');
        $user->cell = $request->get('cell');
        $user->cid = $request->get('cid');
        $user->towID = $request->get('towID');
        $user->steamId = $request->get('steamId');
        $user->IsAdmin = $admin;
        $user->disabled = $disabled;
        $user->role = $request->input('role');
        
        if(strlen($request->input('password')) > 0)
        {
            $user->password = Hash::make($request->input('password'));
        }

        if($disabled == 1)
        {
            $user->remember_token = null;
        }
        $user->saveOrFail();

        return back()->with('message', "Saved User");

    }

}
