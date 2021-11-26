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
use Illuminate\Support\Facades\Http;

class ActionController extends BaseController
{


    function ClockInOut(Request $request, $action)
    {
            $state = $action == 'Off-Duty' ? 0 : 1;
            DB::table('users')
            ->where('id',Auth::id())
            ->update([
                'onDuty' =>$state,
                'workingAs' => $action
        ]);

            $route = $action == 'Mechanic' ? '/repairs' : '/';
            $state == 1 ? $this->OnDuty(Auth::user()->name,$action) : $this->OffDuty(Auth::user()->name);

            return redirect($route);
    }

    function OnDuty($name,$action)
    {
        return Http::post(env('DISCORD_TIMESHEET_WEBHOOK'), [
            "embeds"=> [
            [
                "title"=> $name." has started work",
                "description"=> $name." has clocked in as ".$action." at ".now(),
                "color"=> 1044011,
                "author"=> [
                    "name"=> env('COMPANY_NAME')." Time Tracker"
                    ]
                ]
            ],
        ]);
    }
    function OffDuty($name)
    {
        return Http::post(env('DISCORD_TIMESHEET_WEBHOOK'), [
            "embeds"=> [
                [
                    "title"=> $name." has stopped work",
                    "description"=> $name." has clocked out at ".now(),
                    "color"=> 15604751,
                    "author"=> [
                        "name"=> env('COMPANY_NAME')." Time Tracker"
                    ]
                ]
            ],
        ]);
    }
}
