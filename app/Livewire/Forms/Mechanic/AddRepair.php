<?php

namespace App\Livewire\Forms\Mechanic;

use App\Models\RepairLog;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddRepair extends Component
{
    public $submitting = false;

    public $mechanics;
    public $vehicles;

    public $input_mechanic;
    public $input_vehicle;
    public $input_customer = "Unknown";
    public $input_scrap = 0 ;
    public $input_aluminium = 0;
    public $input_steel = 0;
    public $input_glass = 0;
    public $input_rubber = 0;
    public $input_advKit = 0;
    public $input_oil = 0;
    public $input_finalCost = 0;


    public function mount()
    {
        $this->mechanics = User::whereDisabled('0')->get();
        $this->getVehicles();

        $this->input_mechanic = Auth::id();
        $this->input_vehicle = "No Vehicle Specified";
    }

    public function render()
    {
        return view('livewire.forms.mechanic.add-repair');
    }

    public function save()
    {
        $this->logRepair();
        $this->resetForm();
        $this->dispatch('resetSelect2');

    }

    public function resetForm(){
        $this->reset();
        $this->mechanics = User::whereDisabled('0')->get();
        $this->getVehicles();

        $this->input_mechanic = Auth::id();
        $this->input_vehicle = "No Vehicle Specified";

        $this->input_customer = "Unknown";
        $this->input_scrap = 0 ;
        $this->input_aluminium = 0;
        $this->input_steel = 0;
        $this->input_glass = 0;
        $this->input_rubber = 0;
        $this->input_advKit = 0;
        $this->input_oil = 0;
        $this->input_finalCost = 0;
    }

    private function getVehicles()
    {
        try {
            $client = new Client(['base_uri' => "https://legacyrp.company/",'timeout' => 5, 'verify' => false]);
            $response = $client->request('GET', '/op-framework/vehicles.json');
            $this->vehicles = json_decode($response->getBody());
        }
        catch (\Exception $e)
        {
            $this->vehicles = json_decode('{"data":{"pdm":[],"edm":[],"addon":[]}}');
        }
    }

    private function logRepair()
    {
        $mechanic = User::whereId($this->input_mechanic)->select()->first();

        $repair = new RepairLog();
        $repair->mechanic = $this->input_mechanic;
        $repair->cid = $mechanic->cid;
        $repair->customer_name = $this->input_customer;
        $repair->vehicle = $this->input_vehicle;
        $repair->scrap_used = $this->input_scrap;
        $repair->alum_used = $this->input_aluminium;
        $repair->steel_used = $this->input_steel;
        $repair->glass_used = $this->input_glass;
        $repair->rubber_used = $this->input_rubber;
        $repair->advKit = $this->input_advKit;
        $repair->oil = $this->input_oil;
        $repair->cost = $this->input_finalCost;
        $repair->save();



        if (strlen(Config('app.saleWebhook')) > 0)
        {
            Http::withoutVerifying()->withOptions(["verify"=>false])->post(Config('app.saleWebhook'), [
                "embeds"=> [
                    [
                        "title"=> $mechanic->name." has logged a repair!",
                        "description"=> "See the repair details below:",
                        "color"=> 15358714,
                        "fields" =>
                            [
                                [
                                    "name" => "Mechanic",
                                    "value"=> $mechanic->name,
                                    "inline" => false
                                ],
                                [
                                    "name" => "Customer",
                                    "value"=> empty($customer) ? "N/A" : $customer,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Vehicle",
                                    "value"=> empty($this->input_vehicle) ? "Not Set" : $this->input_vehicle,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Scrap Used",
                                    "value"=> $this->input_scrap,
                                    "inline" => false
                                ],
                                [
                                    "name" => "Aluminium Used",
                                    "value"=> $this->input_aluminium,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Steel Used",
                                    "value"=> $this->input_steel,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Glass Used",
                                    "value"=> $this->input_glass,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Rubber Used",
                                    "value"=> $this->input_rubber,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Adv Repair Kits Sold",
                                    "value"=> $this->input_advKit,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Motor Oil",
                                    "value"=> $this->input_oil,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Total",
                                    "value"=> "$".$this->input_finalCost,
                                    "inline" => false
                                ],
                            ],
                        "author"=> [
                            "name"=> Config('app.companyName')." Live Repair Logger"
                        ],
                        "footer" => [
                            "text" => "Developed By CloudTheWolf 🐺",
                            "icon_url" => "https://cloudthewolf.com/images/pngtuber-closed-2.png"
                        ],
                    ]
                ],
            ]);
        }

    }
}
