<?php

namespace App\Http\Livewire\Mechanic\Dashboard\Self;

use App\Models\RepairLog;
use App\Models\User;
use Livewire\Component;

class RepairCount extends Component
{

    public string $count = '0';
    public function render()
    {
        $user = User::query()->whereId(auth()->id())->first();
        $this->count = number_format(RepairLog::query()->whereCid($user->cid)->whereDeleted(0)->count(),thousands_separator: ',');
        return view('mechanic.dashboard.self.repair-count');
    }
}
