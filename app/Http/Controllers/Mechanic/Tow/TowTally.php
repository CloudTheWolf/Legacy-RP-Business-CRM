<?php

namespace App\Http\Controllers\Mechanic\Tow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TowTally extends Controller
{

    public function Post(Request $request)
    {
        $local = $request->get('local');
        $citizen = $request->get('citizen');
        $pd = $request->get('pd');
        $help = $request->get('help');

        DB::table('tow_log')
            ->updateOrInsert(
                [ "userId" => Auth::id()],
                ["local" => $local, "citizen" => $citizen, "pd" => $pd, "help" => $help]
            );

        return response("{\"status\":\"OK\"}");
    }

}
