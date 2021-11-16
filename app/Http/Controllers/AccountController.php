<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends BaseController
{


    function saveUserOnPost(Request $request)
    {
            DB::table('users')
            ->where('id',$request->input('id'))
            ->update([
            'cell' => $request->input('cell'),
            'cid'=> $request->input('cid'),
            'steamId' => $request->input('steamId'),
            'towID' => $request->input('towID')
        ]);

        if(strlen($request->input('password')) > 0)
        {
            DB::table('users')
                ->where('id',$request->input('id'))
                ->update([
                    'password'=> Hash::make($request->input('password')),
                ]);
        }

        return back()->with('message', "Saved User");
    }

    function editUserView()
    {
        $user = DB::table('users')->where('id',Auth::id())->first();
        return view('manage-user-edit-self')->with('user',$user);
    }



}
