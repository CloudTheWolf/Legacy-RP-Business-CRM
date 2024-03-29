<?php

namespace App\Http\Livewire\Mechanic\Dashboard\Graphs;

use App\Models\RepairLog;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Illuminate\Support\Carbon;
use Livewire\Component;

class SalesGraph extends Component
{
    private LineChartModel $chart;
    public function render()
    {
        $this->draw();
        return view('mechanic.dashboard.graphs.sales-graph')->with('chart',$this->chart);
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
    private function draw(): void
    {
        $repairsThisYear = $this->GetChartData();
        $repairsLastYear = $this->GetChartData(1);

        $this->chart = (new LineChartModel())
            ->setAnimated(true)
            ->setTitle('Sales')
            ->darkMode()
            ->setSmoothCurve()
            ->multiLine()
            ->setColors(['#17caea','#3eea17']);

        foreach($repairsThisYear as $month => $count)
        {
            $this->chart->addSeriesPoint(now()->format('Y'),$month,(int)$count);
        }

        foreach($repairsLastYear as $month => $count)
        {
            $this->chart->addSeriesPoint((now()->format('Y')) - 1,$month,(int)$count);
        }
    }

    /**
     * @param int $yearDiff
     * @return array
     */
    private function GetChartData(int $yearDiff = 0) : array
    {
        $month = 1;
        $yearData = array();
        while($month <= 12)
        {
            $monthText = Carbon::create()->startOfMonth()->month($month)->startOfMonth()->format('M');
            $monthData = RepairLog::query()->whereDeleted(0)->whereRaw("MONTH(timestamp) = $month")
                ->whereRaw("YEAR(timestamp) = YEAR(CURRENT_TIMESTAMP) - $yearDiff")->count();
            $yearData[$monthText] = $monthData;
            $month++;
        }
        return $yearData;
    }


}
