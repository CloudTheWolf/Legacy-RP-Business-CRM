<?php

namespace App\Http\Controllers\Mechanic\Repair;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\RepairLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class RepairDelete extends Controller
{
    public function Get(Request $request, $id)
    {
        $repair = RepairLog::whereId($id)->first();
        $repair->deleted = 1;
        $repair->save();
        return redirect(url('/mechanic/repairs'));
    }

}
