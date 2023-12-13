<?php

namespace App\Http\Livewire\Mechanic\Forms;

use App\Http\Livewire\Mechanic\Dashboard\Graphs\ThisMonth;
use App\Models\RepairLog;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use \Illuminate\Contracts\Foundation\Application as ContractedApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Throwable;

class RepairEditor extends Component
{
    public int $mechanic;
    public bool $checkbox;
    public string $customer;
    public int $scrap,
        $aluminium,
        $steel,
        $glass,
        $rubber,
        $advanced_repair_kit,
        $motor_oil,
        $final_cost,
        $ten_percent,
        $fifteen_percent,
        $twenty_percent,
        $twenty_five_percent;

    public string $vehicle_name;
    public array $options = [];
    public int $repairId;

    public function mount($id)
    {
        $repair = RepairLog::query()->whereId($id)->first();
        $this->repairId = $id;
        $this->mechanic = $repair->mechanic;
        $this->customer = $repair->customer_name;
        $this->scrap = $repair->scrap_used;
        $this->aluminium = $repair->alum_used;
        $this->steel = $repair->steel_used;
        $this->glass = $repair->glass_used;
        $this->rubber = $repair->rubber_used;
        $this->advanced_repair_kit = $repair->advKit;
        $this->motor_oil = $repair->oil;
        $this->final_cost = $repair->cost;
        $this->ten_percent = $repair->cost * 0.9;
        $this->fifteen_percent = $repair->cost * 0.85;
        $this->twenty_percent = $repair->cost * 0.80;
        $this->twenty_five_percent = $repair->cost * 0.75;
        $this->vehicle_name = $repair->vehicle;
        $this->options = [];
    }
    public function render(): View|Application|Factory|ContractedApplication
    {
        $mechanics = $this->getAllMechanics();

        return view('mechanic.forms.repair-logger',compact('mechanics'));
    }

    public function save()
    {
        try {
            $mechanic = User::query()->whereId($this->mechanic)->first();
            $repair = RepairLog::query()->whereId($this->repairId)->first();
            $repair->mechanic = $mechanic->id;
            $repair->cid = $mechanic->cid;
            $repair->scrap_used = $this->scrap;
            $repair->alum_used = $this->aluminium;
            $repair->steel_used = $this->steel;
            $repair->glass_used = $this->glass;
            $repair->rubber_used = $this->rubber;
            $repair->advKit = $this->advanced_repair_kit;
            $repair->oil = $this->motor_oil;

            $repair->vehicle = $this->vehicle_name;
            $repair->customer_name = $this->customer;
            $repair->cost = $this->final_cost;
            $repair->saveOrFail();
        } catch (Throwable $t) {
            return redirect()->back()->with('repair-log-error', 'Error'.$t->getMessage())->with('navigate', true);
        }
        return redirect(route('mechanic-repair-log-index'))->with('repair-log-success', 'Repair Updated Successful')->with('navigate', true);

    }

    public function updated($propertyName) : void
    {
        $this->checkbox = false;
        if ($propertyName === 'vehicle_name') {
            if (strlen($this->vehicle_name) >= 3) {
                $client = new Client(['base_uri' => env("API_BASE_URI"), 'timeout' => 5, 'verify' => env('VERIFY_HTTPS', true),
                    'Authorization' => 'Bearer '.env("OP_FW_API_KEY")]);
                $response = $client->request('GET', '/op-framework/vehicles.json');
                $data = json_decode($response->getBody())->data;
                $this->options = collect($data)
                    ->filter(function ($item) {
                        return str_contains(strtolower($item->label), strtolower($this->vehicle_name));
                    })
                    ->pluck('label')
                    ->toArray();
            } else {
                $this->options = [];
            }
        }

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
        if(!isset($this->advanced_repair_kit))
        {
            $this->advanced_repair_kit = 0;
        }
        if(!isset($this->motor_oil))
        {
            $this->motor_oil = 0;
        }
        $scrap = $this->scrap * config('app.scrap-sell',75);
        $aluminium = $this->aluminium * Config('app.aluminium-sell',100);
        $steel = $this->steel * Config('app.steel-sell',125);
        $glass = $this->glass * Config('app.glass-sell',45);
        $rubber = $this->rubber * Config('app.rubber-sell',20);
        $advanced_repair_kit = $this->advanced_repair_kit * Config('app.adv-repair-kit-sell',600);
        $motor_oil = $this->motor_oil * Config('app.oil-sell',600);

        $final_cost = $scrap + $aluminium + $steel + $glass + $rubber + $advanced_repair_kit + $motor_oil;

        $this->final_cost = $final_cost;
        $this->ten_percent = $final_cost * 0.90;
        $this->fifteen_percent =  $final_cost * 0.85;
        $this->twenty_percent = $final_cost * 0.80;
        $this->twenty_five_percent = $final_cost * 0.75;

    }

    public function selectOption($option)
    {
        $this->vehicle_name = $option;
        $this->options = [];
    }

    private function getAllMechanics() : Collection
    {
        return User::query()->whereDisabled(0)->where('role','!=', 'Tow Driver')->orderBy('name')->get();
    }

}
