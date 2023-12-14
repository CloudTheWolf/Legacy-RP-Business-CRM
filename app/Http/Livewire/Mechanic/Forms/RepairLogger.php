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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Throwable;

class RepairLogger extends Component
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

    public function mount(){
        $this->mechanic = auth()->id();
        $this->customer = 'Unknown';
        $this->scrap = 0;
        $this->aluminium = 0;
        $this->steel = 0;
        $this->glass = 0;
        $this->rubber = 0;
        $this->advanced_repair_kit = 0;
        $this->motor_oil = 0;
        $this->final_cost = 0;
        $this->ten_percent = 0;
        $this->fifteen_percent = 0;
        $this->twenty_percent = 0;
        $this->twenty_five_percent = 0;
        $this->vehicle_name = 'Unknown/No Vehicle';
        $this->options = [];
        $this->is_loading = false;
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
            $repair = new RepairLog();
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
            if(Config::get('app.postSales') != 1)
            {
                return redirect()->route('mechanic-repair-log-index')->with('repair-log-success', 'Success');
            }
            $this->LogToDiscord();
        } catch (Throwable $t) {
            return redirect()->back()->with('repair-log-error', 'Error'.$t->getMessage());
        } finally {
            $this->reset();
        }
        return redirect()->route('mechanic-repair-log-index')->with('repair-log-success', 'Success');

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

    private function LogToDiscord()
    {
        Http::withoutVerifying()->withOptions(["verify"=>false])->post(Config('app.saleWebhook'), [
            "embeds"=> [
                [
                    "title"=> Auth::user()->name ." has logged a repair!",
                    "description"=> "See the repair details below:",
                    "color"=> hexdec(Config::get('app.discord-embed-color','EA5AFA')),
                    "fields" =>
                        [
                            [
                                "name" => "Mechanic",
                                "value"=> Auth::user()->name,
                                "inline" => false
                            ],
                            [
                                "name" => "Customer",
                                "value"=> $this->customer,
                                "inline" => true
                            ],
                            [
                                "name" => "Vehicle",
                                "value"=> $this->vehicle_name,
                                "inline" => true
                            ],
                            [
                                "name" => "Scrap Used",
                                "value"=> $this->scrap,
                                "inline" => false
                            ],
                            [
                                "name" => "Aluminium Used",
                                "value"=> $this->aluminium,
                                "inline" => true
                            ],
                            [
                                "name" => "Steel Used",
                                "value"=> $this->steel,
                                "inline" => true
                            ],
                            [
                                "name" => "Glass Used",
                                "value"=> $this->glass,
                                "inline" => true
                            ],
                            [
                                "name" => "Rubber Used",
                                "value"=> $this->rubber,
                                "inline" => true
                            ],
                            [
                                "name" => "Adv Repair Kits Sold",
                                "value"=> $this->advanced_repair_kit,
                                "inline" => true
                            ],
                            [
                                "name" => "Motor Oil",
                                "value"=> $this->motor_oil,
                                "inline" => true
                            ],
                            [
                                "name" => "Total",
                                "value"=> "$".$this->final_cost,
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
