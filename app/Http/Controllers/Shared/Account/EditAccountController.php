<?php

namespace App\Http\Controllers\Shared\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EditAccountController extends Controller
{
    public function Get(Request $request)
    {
        $user = User::whereId(Auth::user()->id)->first();

        return view('Shared.Account.edit',compact('user'));
    }

    public function Post(Request $request)
    {
        $user = User::whereId(Auth::user()->id)->first();
        $user->name = $request->get("name");
        $user->cell = $request->get('cell');
        $user->towID = $request->get('towID');
        $user->steamId = $request->get('steamId');

        if(strlen($request->input('password')) > 0)
        {
            $user->password = Hash::make($request->input('password'));
        }
        $user->saveOrFail();

        return back()->with('message', "Profile Updated");

    }

}
