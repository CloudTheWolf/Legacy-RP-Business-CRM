<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VersionOne extends Controller
{
    public function GetAllActiveUsers(Request $request)
    {
        abort_if(!$request->hasHeader("x-api-key") || $request->header("x-api-key") != env('SITE_API_KEY'), '403');
        $users = User::query()->whereDisabled(0)->where('role','!=','IT Support')
            ->select('id','cid','name','email','cell','towID','role','workingAs','steamId','discord','onDuty')
            ->get();
        return json_encode($users);
    }
}
