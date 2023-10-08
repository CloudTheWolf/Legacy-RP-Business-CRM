<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\RepairLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Shared\GetCityData;

class DashboardController extends Controller
{
    public function Get()
    {
        // Get Current On Duty
        $onDuty = User::whereOnDuty('1')->count();
        $onDutyList = User::whereOnDuty('1')->select(["name","workingAs"])->get();

        //Get In City Count
        //$citizens = GetCityData::GetInCityCount();

        // Calculate Income Values
        $month = Carbon::now()->format('M');
        $year = $month == "Jan" ? "YEAR(CURRENT_TIMESTAMP) -1" : "YEAR(CURRENT_TIMESTAMP)";
        $lastMonth = Carbon::now()->subMonth()->format('m');
        $total = RepairLog::whereDeleted(0);
        $totalCount = $total->count();
        $totalIncome = $total->select('cost')->sum('cost');

        $lastMonthCount = $total->whereRaw('MONTH(`repair_log`.`timestamp`) = \''.$lastMonth.'\' and '.
            'YEAR(`repair_log`.`timestamp`) = '.$year)->count();
        $lastMonthIncome = $total->whereRaw('MONTH(`repair_log`.`timestamp`) = \''.$lastMonth.'\' and '.
            'YEAR(`repair_log`.`timestamp`) = '.$year)->select('cost')->sum('cost');

        $thisMonthCount = RepairLog::query()->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) and '.
            'YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP)')->count();
        $thisMonthIncome = RepairLog::query()->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) and '.
            'YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP)')->select('cost')->sum('cost');

        return view("Mechanics.dashboard",compact("onDuty","onDutyList","totalCount",
            "totalIncome","lastMonthCount","lastMonthIncome","thisMonthCount","thisMonthIncome"));
    }

}
