<?php

namespace App\Http\Controllers\Mechanic\Repair;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\RepairLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class Repairs extends Controller
{
    public function Get()
    {
        $latest = RepairLog::whereDeleted("0")->selectRaw("repair_log.*,users.name")->join('users','repair_log.mechanic','=','users.id')->orderByDesc("timestamp")->paginate(25);
        return view('Mechanics.Repair.repairs', compact( "latest"));
    }

}
