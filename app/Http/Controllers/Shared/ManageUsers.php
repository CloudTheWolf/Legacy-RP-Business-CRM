<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUsers extends Controller
{
    public function List()
    {
        $users = User::query()->whereDisabled(0)->where('role','!=','IT Support')->get();
        return view('shared.manage-users',compact('users'));
    }

    public function ListDisabled()
    {
        $users = User::query()->whereDisabled(1)->get();
        return view('shared.manage-disabled-users',compact('users'));
    }

    public function Edit($id)
    {
        return view ('shared.add-edit-user',compact(['id']));
    }

    public function Add()
    {
        return view ('shared.add-edit-user')->with('id',null);
    }
}
