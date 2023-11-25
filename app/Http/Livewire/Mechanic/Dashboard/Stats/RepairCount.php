<?php

namespace App\Http\Livewire\Mechanic\Dashboard\Stats;

use App\Models\RepairLog;
use Livewire\Component;

class RepairCount extends Component
{
    public string $count = '0';
    public function render()
    {
        $this->count = number_format(RepairLog::query()->whereDeleted(0)->count(),thousands_separator: ',');
        return view('mechanic.dashboard.stats.repair-count');
    }
}
