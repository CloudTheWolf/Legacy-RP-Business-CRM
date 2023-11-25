<?php

namespace App\Http\Livewire\Shared\Dashboard\Stats;

use App\Models\User;
use Livewire\Component;

class OnDuty extends Component
{
    public string $count;
    public function render()
    {
        $this->count = number_format(User::whereOnDuty('1')->count());
        return view('shared.dashboard.stats.on-duty');
    }
}
