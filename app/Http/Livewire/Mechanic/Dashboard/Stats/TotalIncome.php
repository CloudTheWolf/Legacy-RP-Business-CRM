<?php

namespace App\Http\Livewire\Mechanic\Dashboard\Stats;

use App\Models\RepairLog;
use Livewire\Component;

class TotalIncome extends Component
{
    public string $income;
    public function render()
    {
        $this->income = "$".number_format(RepairLog::whereDeleted(0)->select('cost')->sum('cost'));
        return view('mechanic.dashboard.stats.total-income');
    }
}
