<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\VgApplications;
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

    function viewJobApplications(Request $request)
    {
        if(config('app.siteMode') == "Mechanic") {
            $applications = Applications::where('state','=','0')->get();
        }
        if(config('app.siteMode') == "Arcade" || config('app.siteMode') == "Bar") {
            $applications = VgApplications::where('state','=','0')->get();
        }

        return view('manage-applications',compact('applications'));
    }

    function viewSingleJobApplication(Request $request)
    {
        if(config('app.siteMode') == "Mechanic") {
            $application = Applications::where('id', '=', $request->id)->first();
            return view('view-application',compact('application'));
        }

        if(config('app.siteMode') == "Arcade" || config('app.siteMode') == "Bar") {
            $application = VgApplications::where('id', '=', $request->id)->first();
            return view('arcade.view-application',compact('application'));
        }

    }

    function processJobRequest(Request $request)
    {
        if($request->input('ack') == 'accept') {
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
        }
        switch(config('app.siteMode')){
            default:
                $application = Applications::where('id', '=', $request->id)->first();
                break;
            case 'Arcade':
            case 'Bar':
                $application = VgApplications::where('id', '=', $request->id)->first();
                break;
        }
        $application->state = 1;
        $application->save();

        return redirect('/admin/applications')->with('message',"User Created/Updated");

    }
}
