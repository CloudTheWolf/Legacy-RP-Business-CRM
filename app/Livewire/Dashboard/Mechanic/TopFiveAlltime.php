<?php

namespace App\Livewire\Dashboard\Mechanic;

use App\Models\RepairLog;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;

class TopFiveAlltime extends Component
{

    private $chart;

    public function render()
    {
        $this->draw();
        return view('livewire.dashboard.mechanic.top-five-alltime')->with('topFiveAll',$this->chart);
    }

    private function draw()
    {
        $sliceColors = ['#15ca20','#fd3550','#008cff','#ffc107','#0dcaf0'];
        $data = RepairLog::query()->selectRaw("users.name,COUNT(repair_log.id) as rCount")
            ->join('users','users.id','=','repair_log.mechanic')
            ->whereDeleted(0)
            ->where('users.disabled','=','0')
            ->groupBy('users.name')->orderBy('rCount','desc')
            ->limit(5)
            ->get();

        $this->chart = (new PieChartModel())
            ->darkMode()
            ->asPie()
            ->setAnimated(true)
            ->setLegendPosition('right');
        $sliceId = 0;
        foreach ($data as $slice)
        {
            $this->chart->addSlice("$slice->name - $slice->rCount",$slice->rCount,$sliceColors[$sliceId]);
            $sliceId++;
        }
    }
}
