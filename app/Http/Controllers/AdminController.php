<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends BaseController
{


    function CreateUserView()
    {
        if(Auth::user()->IsAdmin != 1) abort('401',"You don't have access to this page");
        return view('manage-user-add');
    }

    function CreateUserPost(Request $request)
    {
        if(Auth::user()->IsAdmin != 1) abort('401',"You don't have access to this page");
        $admin = $request->input('isAdmin') == 1 ? 1 : 0;
        DB::table('users')->insert([
            'name'=> $request->input('name'),
            'email'=> $request->input('username'),
            'cell' => $request->input('cell'),
            'password'=> Hash::make($request->input('password')),
            'cid'=> $request->input('cid'),
            'steamId' => $request->input('steamId'),
            'isAdmin'=> $admin,
            'disabled'=> 0,
        ]);
        return back()->with('message', "User Added");
    }

    function saveUserOnPost(Request $request)
    {
        if(Auth::user()->IsAdmin != 1) abort('401',"You don't have access to this page");
        $admin = $request->input('isAdmin') == 1 ? 1 : 0;
        $disabled = $request->input('disabled') == 1 ? 1 : 0;
        DB::table('users')
            ->where('id',$request->input('id'))
            ->update([
            'name'=> $request->input('name'),
            'email'=> $request->input('username'),
            'cell' => $request->input('cell'),
            'cid'=> $request->input('cid'),
            'towID' => $request->input('towID'),
            'steamId' => $request->input('steamId'),
            'isAdmin'=> $admin,
            'disabled'=> $disabled,
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

    function editUserView(Request $request, $id)
    {
        if(Auth::user()->IsAdmin != 1) abort('401',"You don't have access to this page");


        $user = DB::table('users')->where('id',$id)->first();
        return view('manage-user-edit')->with('user',$user);
    }

    function editUserList()
    {
        $users = DB::table('users')->get();
        return view('manage-user-list')->with('users',$users);
    }

}
