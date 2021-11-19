<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TowController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function viewPage()
    {
        $stats = DB::table('tow_log')->where("userId","=",Auth::id())->get();
        $local = "0";
        $citizen = "0";
        $pd = "0";
        $help = "0";

        if ($stats->count() != 0)
        {
            $local = $stats->first()->local;
            $citizen = $stats->first()->citizen;
            $pd = $stats->first()->pd;
            $help = $stats->first()->help;
        }

        return view('tow-log')->with("local",$local)->with("citizen",$citizen)->with("pd",$pd)->with("help",$help);

    }

    function addTally(Request $request)
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

    function submit(Request $request)
    {
        $local = $request->get('local');
        $citizen = $request->get('citizen');
        $pd = $request->get('pd');
        $help = $request->get('help');

        DB::table('tow_log')
            ->updateOrInsert(
                [ "userId" => Auth::id()],
                ["local" => 0, "citizen" => 0, "pd" => 0, "help" => 0]
            );

        Http::post(env('DISCORD_TOW_WEBHOOK'), [
            "embeds"=> [
                [
                    "title"=> Auth::user()->name." Tow Log",
                    "description"=> Auth::user()->name." Tow Log Submitted At ".now(),
                    "color"=> 11022999,
                    "author"=> [
                        "name"=> env('COMPANY_NAME')." Tow Log System"
                    ],
                    "fields" => [
                        [
                            "name" => "🚗 Local Cars",
                            "value" => $local,
                            "inline" => false
                        ],
                        [
                            "name" => "👪 Citizen Cars",
                            "value" => $citizen,
                            "inline" => true
                        ],
                        [
                            "name" => "🚓 PD Callout",
                            "value" => $pd,
                            "inline" => false
                        ],
                        [
                            "name" => "🆘 Generic Help (Transport Vehicle, etc)",
                            "value" => $help,
                            "inline" => true
                        ]
                    ]
                ]
            ],
        ]);

        return view('tow-log',['status','Submitted']);

    }

}
