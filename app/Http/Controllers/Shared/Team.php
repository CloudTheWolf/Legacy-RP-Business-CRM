<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Team extends Controller
{
    public function index()
    {
        $users = User::whereDisabled(0)->get();
        return view('shared.team',compact('users'));
    }
}
