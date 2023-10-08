<?php

namespace App\Livewire\Dashboard\Mechanic;

use App\Models\RepairLog;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Livewire\Component;

class TopFiveThisMonth extends Component
{
    private $chart;
    public function render()
    {
        $this->draw();
        return view('livewire.dashboard.mechanic.top-five-this-month')
            ->with('topFiveThisMonth',$this->chart);
    }

    private function draw()
    {
        $sliceColors = ['#15ca20','#fd3550','#008cff','#ffc107','#0dcaf0'];
        $month = Carbon::now()->format('M');
        $year = $month == "Jan" ? "YEAR(CURRENT_TIMESTAMP) -1" : "YEAR(CURRENT_TIMESTAMP)";

        $data = RepairLog::query()->selectRaw("users.name,COUNT(repair_log.id) as rCount")
            ->join('users','users.id','=','repair_log.mechanic')
            ->whereDeleted(0)
            ->whereRaw('MONTH(`repair_log`.`timestamp`) = MONTH(CURRENT_TIMESTAMP) ')
            ->whereRaw('YEAR(`repair_log`.`timestamp`) = YEAR(CURRENT_TIMESTAMP) ')
            ->where('users.disabled','=','0')
            ->groupBy('users.name')->orderBy('rCount','desc')
            ->limit(5)
            ->get();

        $this->chart = (new PieChartModel())
            ->darkMode()
            ->asDonut()
            ->setAnimated(true)
            ->setLegendPosition('right');
        $sliceId = 0;
        foreach ($data as $slice)
        {
            $this->chart->addSlice("$slice->name - $slice->rCount",(int)$slice->rCount,$sliceColors[$sliceId]);
            $sliceId++;
        }
    }
}
