<?php

namespace App\Http\Controllers\Mechanic\Tow;

use App\Http\Controllers\Controller;
use App\Models\CityTowLog;
use App\Models\TowLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class TowTracker extends Controller
{

    public function Get()
    {

        $stats = TowLog::whereUserId(Auth::id())->get();
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

        $towImpound = CityTowLog::selectRaw('`rowId`, `cityTowLogs`.`id`, `users`.`name`, `timestamp`, `modelName`, `reward`, `playerVehicle`, `plateNumber`')
            ->join('users','users.cid','=', 'cityTowLogs.characterId')->where('users.id','=',Auth::id())
            ->orderBy('timestamp','desc')
            ->paginate(25);
        return view('Mechanics.Tow.tracker', compact("towImpound","local","citizen","pd","help"));
    }

    public function Post(Request $request)
    {
        $local = $request->get('local');
        $citizen = $request->get('citizen');
        $pd = $request->get('pd');
        $help = $request->get('help');

        $log = TowLog::whereUserId(Auth::id())->firstOrNew();
        $log->local = 0;
        $log->citizen = 0;
        $log->pd = 0;
        $log->help = 0;
        $log->save();
        Http::post(Config('app.towWebhook'), [
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

        return back()->with('message','Submitted');

    }

}
