<?php

namespace App\Http\Livewire\Mechanic\Forms;

use App\Http\Livewire\Mechanic\Dashboard\Graphs\ThisMonth;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class RepairLogger extends Component
{
    public int $mechanic;
    public string $customer = 'Unknown';
    public int $scrap = 0,
        $aluminium = 0,
        $steel = 0,
        $glass = 0,
        $rubber = 0,
        $advanced_repair_kit = 0,
        $motor_oil = 0,
        $final_cost = 0,
        $ten_percent = 0,
        $fifteen_percent = 0,
        $twenty_percent = 0,
        $twenty_five_percent = 0;

    public string $search = 'Unknown/No Vehicle';
    public array $options = [];
    public function render()
    {

        $this->mechanic = auth()->id();
        $mechanics = $this->getAllMechanics();

        return view('mechanic.forms.repair-logger',compact('mechanics'));
    }

    public function updated($propertyName) : void
    {
        if ($propertyName === 'search') {
            if (strlen($this->search) >= 3) {
                $client = new Client(['base_uri' => env("API_BASE_URI"), 'timeout' => 5, 'verify' => env('VERIFY_HTTPS', true)]);
                $response = $client->request('GET', '/op-framework/vehicles.json');
                $data = json_decode($response->getBody())->data;
                $this->options = collect($data)
                    ->filter(function ($item) {
                        return str_contains(strtolower($item->label), strtolower($this->search));
                    })
                    ->pluck('label')
                    ->toArray();
            } else {
                $this->options = [];
            }
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
        $this->ten_percent = $final_cost * 0.10;
        $this->fifteen_percent =  $final_cost * 0.15;
        $this->twenty_percent = $final_cost * 0.20;
        $this->twenty_five_percent = $final_cost * 0.25;

    }

    public function selectOption($option)
    {
        $this->search = $option;
        $this->options = [];
    }

    private function getAllMechanics() : Collection
    {
        return User::query()->whereDisabled(0)->where('role','!=', 'Tow Driver')->get();
    }

}
