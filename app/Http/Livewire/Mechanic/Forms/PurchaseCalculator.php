<?php

namespace App\Http\Livewire\Mechanic\Forms;

use App\Models\BuyTemplate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PurchaseCalculator extends Component
{
    public int $scrap,
        $aluminium,
        $steel,
        $glass,
        $rubber,
        $final_cost;

    public function mount()
    {

        $saved = BuyTemplate::whereUserId(Auth::id());
        $hasValues = ($saved->count() != 0);
        $saved = $saved->first();
        $this->scrap = $hasValues ? $saved->scrap : 0;
        $this->aluminium = $hasValues ? $saved->alum : 0;
        $this->steel = $hasValues ? $saved->steel : 0;
        $this->glass = $hasValues ? $saved->glass : 0;
        $this->rubber = $hasValues ? $saved->rubber : 0;
        $this->updated();
    }

    public function render()
    {
        return view('mechanic.forms.purchase-calculator');
    }

    public function updated()
    {
        if(!isset($this->scrap))
        {
            $this->scrap = 0;
        }
        if(!isset($this->aluminium))
        {
            $this->aluminium = 0;
        }
        if(!isset($this->steel))
        {
            $this->steel = 0;
        }
        if(!isset($this->glass))
        {
            $this->glass = 0;
        }
        if(!isset($this->rubber))
        {
            $this->rubber = 0;
        }

        $scrap = $this->scrap * config('app.scrap-buy',50);
        $aluminium = $this->aluminium * config('app.aluminium-buy',90);
        $steel = $this->steel * config('app.steel-buy',100);
        $glass = $this->glass * config('app.glass-buy',30);
        $rubber = $this->rubber * config('app.rubber-buy',10);


        $this->final_cost = $scrap + $aluminium + $steel + $glass + $rubber;
    }

    public function SetToZero()
    {
        $this->scrap = 0;
        $this->aluminium = 0;
        $this->steel = 0;
        $this->glass = 0;
        $this->rubber = 0;
        $this->save();

    }

    public function save()
    {
        $buy = BuyTemplate::whereUserId(Auth::id())->firstOrNew();
        $buy->scrap = $this->scrap;
        $buy->alum = $this->aluminium;
        $buy->steel = $this->steel;
        $buy->glass = $this->glass;
        $buy->rubber = $this->rubber;
        $buy->save();
        $this->mount();
        return redirect()->back()->with('save-success', 'Calculator Saved');

    }
}
