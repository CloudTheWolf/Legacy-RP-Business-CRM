<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    function ViewAllStorage()
    {
        if(Auth::user()->IsAdmin != 1) abort('401',"You don't have access to this page");
        return view('admin-storage');
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
            'role' => $request->input('role'),
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

        if(strlen($request->input('role')) > 0)
        {
            DB::table('users')
                ->where('id',$request->input('id'))
                ->update([
                    'role'=> $request->input('role'),
                ]);
        }

        if(strlen($request->input('password')) > 0)
        {
            DB::table('users')
                ->where('id',$request->input('id'))
                ->update([
                    'password'=> Hash::make($request->input('password')),
                ]);
        }

        if($disabled == 1)
        {
            DB::table('users')
                ->where('id',$request->input('id'))
                ->update([
                    'remember_token'=> null,
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
        $users = DB::table('users')->orderBy("disabled")->get();
        return view('manage-user-list')->with('users',$users);
    }

}
