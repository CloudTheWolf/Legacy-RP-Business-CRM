<?php

namespace App\Http\Livewire\Mechanic\Dashboard\Tables;

use App\Models\RepairLog;
use Carbon\Carbon;
use Livewire\Component;

class Stats extends Component
{
    public function render()
    {
        $total = RepairLog::whereDeleted(0);
        $month = Carbon::now()->format('m');
        $year = $month == "Jan" ? "YEAR(CURRENT_TIMESTAMP) -1" : "YEAR(CURRENT_TIMESTAMP)";
        $lastMonth = Carbon::now()->subMonthsNoOverflow()->format('m');

        $lastMonthCount = $total->whereRaw('MONTH(`repair_log`.`timestamp`) = \''.$lastMonth.'\' and '.
            'YEAR(`repair_log`.`timestamp`) = '.$year)->count();
        $lastMonthIncome = $total->whereRaw('MONTH(`repair_log`.`timestamp`) = \''.$lastMonth.'\' and '.
            'YEAR(`repair_log`.`timestamp`) = '.$year)->select('cost')->sum('cost');

        $thisMonthCount = RepairLog::query()->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) and '.
            'YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP)')->count();
        $thisMonthIncome = RepairLog::query()->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) and '.
            'YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP)')->select('cost')->sum('cost');
        return view('mechanic.dashboard.tables.stats',compact('thisMonthCount','thisMonthIncome','lastMonthCount','lastMonthIncome'));
    }
}
