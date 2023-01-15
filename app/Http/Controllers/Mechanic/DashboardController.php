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
        $citizens = GetCityData::GetInCityCount();
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

        $pie  = DB::select('SELECT users.name,COUNT(repair_log.id) as count FROM `repair_log` inner join users on `users`.`id` = `repair_log`.`mechanic` where `repair_log`.`deleted` = 0 AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');
        if($month == "Jan") {
            $pie2 = DB::select('SELECT users.name,COUNT(repair_log.id) as count FROM `repair_log` inner join users on `users`.`id` = `repair_log`.`mechanic` where `repair_log`.`deleted` = 0 AND MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) + 11 AND YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP) - 1 AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');
        } else {
            $pie2 = DB::select('SELECT users.name,COUNT(repair_log.id) as count FROM `repair_log` inner join users on `users`.`id` = `repair_log`.`mechanic` where `repair_log`.`deleted` = 0 AND MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) - 1 AND YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP) AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');
        }
        $pie3 = DB::select('SELECT users.name,COUNT(repair_log.id) as count FROM `repair_log` inner join users on `users`.`id` = `repair_log`.`mechanic` where `repair_log`.`deleted` = 0 AND MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) AND YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP) AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');

        $tJan = $this->GetChartData(1);
        $tFeb = $this->GetChartData(2);
        $tMar = $this->GetChartData(3);
        $tApr = $this->GetChartData(4);
        $tMay = $this->GetChartData(5);
        $tJun = $this->GetChartData(6);
        $tJul = $this->GetChartData(7);
        $tAug = $this->GetChartData(8);
        $tSep = $this->GetChartData(9);
        $tOct = $this->GetChartData(10);
        $tNov = $this->GetChartData(11);
        $tDec = $this->GetChartData(12);
        $lJan = $this->GetChartData(1,false);
        $lFeb = $this->GetChartData(2,false);
        $lMar = $this->GetChartData(3,false);
        $lApr = $this->GetChartData(4,false);
        $lMay = $this->GetChartData(5,false);
        $lJun = $this->GetChartData(6,false);
        $lJul = $this->GetChartData(7,false);
        $lAug = $this->GetChartData(8,false);
        $lSep = $this->GetChartData(9,false);
        $lOct = $this->GetChartData(10,false);
        $lNov = $this->GetChartData(11,false);
        $lDec = $this->GetChartData(12,false);

        return view("Mechanics.dashboard",compact("onDuty","onDutyList","citizens","totalCount",
            "totalIncome","lastMonthCount","lastMonthIncome","thisMonthCount","thisMonthIncome","pie","pie2","pie3",
            "tJan","tFeb","tMar","tApr","tMay","tJun","tJul","tAug","tSep","tOct","tNov","tDec",
            "lJan","lFeb","lMar","lApr","lMay","lJun","lJul","lAug","lSep","lOct","lNov","lDec"));
    }


    private function GetChartData($month,$thisYear = true): array
    {
        if($thisYear) {
            return DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND '.
                'MONTH(timestamp) = '.$month.' and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) ');
        }
        return DB::select('SELECT COUNT(*) as count FROM `repair_log` WHERE deleted = 0 AND '.
            'MONTH(timestamp) = '.$month.' and YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - 1');
    }
}
