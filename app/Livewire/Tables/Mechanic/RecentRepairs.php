<?php

namespace App\Livewire\Tables\Mechanic;

use App\Models\RepairLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class RecentRepairs extends Component
{

    protected $listeners = ['updateTable' => 'updateTable'];

    public $latest;

    public function updateTable()
    {
        $this->latest = null;
        $this->render();
    }

    public function render()
    {
        $this->latest = RepairLog::whereMechanic(Auth::user()->id)->orderByDesc("timestamp")->limit(25)->get();
        return view('livewire.tables.mechanic.recent-repairs');
    }
}
