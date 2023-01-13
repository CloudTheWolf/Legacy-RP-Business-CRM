<?php

namespace App\Http\Controllers\Bars;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Shared\GetCityData;
use App\Models\BarSales;
use App\Models\RepairLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function Get()
    {
        // Get Current On Duty
        $onDuty = User::whereOnDuty('1')->count();
        $onDutyList = User::whereOnDuty('1')->select(["name","workingAs"])->get();

        // Get chart sales data
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

        //Get In City Count
        $citizens = GetCityData::GetInCityCount();

        // Calculate Income Values
        $month = Carbon::now()->format('M');
        $year = $month == "Jan" ? "YEAR(CURRENT_TIMESTAMP) -1" : "YEAR(CURRENT_TIMESTAMP)";

        $total = BarSales::whereDeleted(0);
        $totalCount = $total->count();
        $totalIncome = $total->select('finalCost')->sum('finalCost');

        $lastMonthCount = $total->whereRaw('MONTH(`barSales`.`created_at`) = MONTH(CURRENT_TIMESTAMP) -1 and '.
            'YEAR(`barSales`.`created_at`) = '.$year)->count();
        $lastMonthIncome = $total->whereRaw('MONTH(`barSales`.`created_at`) = MONTH(CURRENT_TIMESTAMP) -1 and '.
            'YEAR(`barSales`.`created_at`) = '.$year)->select('finalCost')->sum('finalCost');

        $thisMonthCount = BarSales::query()->whereRaw('MONTH(`barSales`.`created_at`) = MONTH(CURRENT_TIMESTAMP) and '.
            'YEAR(`barSales`.`created_at`) = YEAR(CURRENT_TIMESTAMP)')->count();
        $thisMonthIncome = BarSales::query()->whereRaw('MONTH(`barSales`.`created_at`) = MONTH(CURRENT_TIMESTAMP) and '.
            'YEAR(`barSales`.`created_at`) = YEAR(CURRENT_TIMESTAMP)')->select('finalCost')->sum('finalCost');

        $pie  = DB::select('SELECT users.name,COUNT(barSales.id) as count FROM `barSales` inner join users on `users`.`id` = `barSales`.`staff` where `barSales`.`deleted` = 0 AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');
        if($month == "Jan") {
            $pie2 = DB::select('SELECT users.name,COUNT(barSales.id) as count FROM `barSales` inner join users on `users`.`id` = `barSales`.`staff` where `barSales`.`deleted` = 0 AND MONTH(`barSales`.`created_at`) = MONTH(CURRENT_TIMESTAMP) + 11 AND YEAR(`barSales`.`created_at`) = YEAR(CURRENT_TIMESTAMP) - 1 AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');
        } else {
            $pie2 = DB::select('SELECT users.name,COUNT(barSales.id) as count FROM `barSales` inner join users on `users`.`id` = `barSales`.`staff` where `barSales`.`deleted` = 0 AND MONTH(`barSales`.`created_at`) = MONTH(CURRENT_TIMESTAMP) - 1 AND YEAR(`barSales`.`created_at`) = YEAR(CURRENT_TIMESTAMP) AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');
        }
        $pie3 = DB::select('SELECT users.name,COUNT(barSales.id) as count FROM `barSales` inner join users on `users`.`id` = `barSales`.`staff` where `barSales`.`deleted` = 0 AND MONTH(`barSales`.`created_at`) = MONTH(CURRENT_TIMESTAMP) AND YEAR(`barSales`.`created_at`) = YEAR(CURRENT_TIMESTAMP) AND `users`.`disabled` = 0 GROUP BY users.name ORDER BY count DESC');


        return view("BarClub.dashboard",compact("onDuty","onDutyList","citizens","totalCount",
            "totalIncome","lastMonthCount","lastMonthIncome","thisMonthCount","thisMonthIncome","pie","pie2","pie3",
            "tJan","tFeb","tMar","tApr","tMay","tJun","tJul","tAug","tSep","tOct","tNov","tDec",
            "lJan","lFeb","lMar","lApr","lMay","lJun","lJul","lAug","lSep","lOct","lNov","lDec"));

    }

    private function GetChartData($month,$thisYear = true): int
    {
        $yearQuery = $thisYear ? 'YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)' : 'YEAR(created_at) = YEAR(CURRENT_TIMESTAMP) - 1';
        return BarSales::query()->where('deleted','=','0')->whereRaw($yearQuery)->whereRaw("MONTH(created_at) =".$month)->count();
    }

}
