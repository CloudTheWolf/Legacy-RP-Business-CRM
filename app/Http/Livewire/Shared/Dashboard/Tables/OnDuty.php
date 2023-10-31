<?php

namespace App\Http\Livewire\Shared\Dashboard\Tables;

use App\Models\User;
use Livewire\Component;

class OnDuty extends Component
{
    public function render()
    {
        return view('shared.dashboard.tables.on-duty',[
            'onDutyList' => User::whereOnDuty('1')->select(["name","workingAs"])->orderBy('workingAs')->get()
        ]);
    }


}
