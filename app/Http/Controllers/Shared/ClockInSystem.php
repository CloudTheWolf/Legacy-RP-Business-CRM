<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ClockInSystem extends Controller
{
    public function handle($action): RedirectResponse
    {
        $state = $action == 'Off-Duty' ? 0 : 1;
        $user = User::query()->whereId(Auth::user()->id)->first();
        $user->onDuty = $state;
        $user->workingAs = $action;
        $user->save();
        $route = match ($action) {
            "Mechanic" => 'mechanic-repair-log-index',
            "Tow" => 'tow-tracker',
            default => 'dashboard',
        };

        $state == 1 ? $this->OnDuty(Auth::user()->name,$action) : $this->OffDuty(Auth::user()->name);

        return redirect()->route($route);
    }

    private function OnDuty($name, $action) : void
    {
        $isOnDuty = WorkTime::query()->whereCid(Auth::user()->cid)->whereNull('clockOutAt')->count();
        if($isOnDuty === 0)
        {
            $start = new WorkTime();
            $start->cid = Auth::user()->cid;
            $start->save();
        }

        if(Config('app.timesheetWebhook') == '')
        {
            return;
        }
        Http::withoutVerifying()->post(Config('app.timesheetWebhook'), [
            "embeds"=> [
                [
                    "title"=> $name." has started work",
                    "description"=> $name." has clocked in as ".$action." @ ".now(),
                    "color"=> 1044011,
                    "author"=> [
                        "name"=> env('COMPANY_NAME')." Time Tracker"
                    ]
                ]
            ],
        ]);
    }

    private function OffDuty($name)
    {
        $now = Carbon::now('UTC');
        $timesheet = WorkTime::query()->whereCid(Auth::user()->cid)->whereNull('clockOutAt');
        if($timesheet->count() > 0)
        {
            // Eloquent does not seem to work with the clockout time
            // Falling back to DB::table method

            DB::table("workTime")->where([
                "cid" => Auth::user()->cid,
            ])->whereNull('clockOutAt')->update([
                'clockOutAt' => $now
            ]);
        }

        if(Config('app.timesheetWebhook') == '')
        {
            return;
        }
        Http::withoutVerifying()->post(Config('app.timesheetWebhook'), [
            "embeds"=> [
                [
                    "title"=> $name." has stopped work",
                    "description"=> $name." has clocked out @ ".$now,
                    "color"=> 15604751,
                    "author"=> [
                        "name"=> env('COMPANY_NAME')." Time Tracker"
                    ]
                ]
            ],
        ]);
    }
}
