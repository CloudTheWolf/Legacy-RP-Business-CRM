<?php

namespace App\Http\Livewire\Mechanic\Dashboard\Graphs;

use App\Models\RepairLog;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Livewire\Component;

class ThisMonth extends Component
{
    private PieChartModel $chart;
    public function render()
    {
        $this->draw();
        return view('mechanic.dashboard.graphs.this-month')->with('chart',$this->chart);
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="flex justify-center">
            <!-- Loading spinner... -->
            <svg width="90" height="90" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <style>
                .spinner_0XTQ{
                        fill: white;
                        transform-origin:center;
                        animation:spinner_y6GP .75s linear infinite
                        }
                @keyframes spinner_y6GP{100%{transform:rotate(360deg)}}
                </style><path class="spinner_0XTQ" d="M12,23a9.63,9.63,0,0,1-8-9.5,9.51,9.51,0,0,1,6.79-9.1A1.66,1.66,0,0,0,12,2.81h0a1.67,1.67,0,0,0-1.94-1.64A11,11,0,0,0,12,23Z"/></svg>
        </div>
        HTML;
    }

    /**
     * @return void
     */
    private function draw()
    {
        $sliceColors = ['#15ca20','#fd3550','#008cff','#ffc107','#0dcaf0'];
        $month = Carbon::now()->format('M');
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
            ->setTitle('Top 5 This Month')
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
