<?php

namespace App\Http\Controllers\Mechanic\Repair;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\RepairLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class RepairEdit extends Controller
{
    public function Get(Request $request, $id)
    {
        try{
            $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 60]);
            $response = $client->request('GET', '/op-framework/vehicles.json');
            $vehicles = json_decode($response->getBody());
        }
        catch (\Exception $e)
        {
            $vehicles = json_decode('{"data":{"pdm":[],"edm":[],"addon":[]}}');
        }
        $latest = RepairLog::whereMechanic(Auth::user()->id)->orderByDesc("timestamp")->limit(25)->get();
        $repair = RepairLog::whereId($id)->first();
        $mechanics = User::whereDisabled('0')->get();
        $settings = Configuration::whereGroup("mechanic")->get();
        return view('Mechanics.Repair.repair-update',compact('repair',"vehicles","latest","mechanics","settings"));
    }

    public function Post(Request $request,$id)
    {
        $this->logRepair($id,$request->input('mechanic'),$request->input('customer'),$request->input('vehicle'),$request->input('scrap'),$request->input('aluminium'),$request->input('steel'),$request->input('glass'),$request->input('rubber'),$request->input('FinalCost'));
        return back()->with(['message' => "Log Updated"]);
    }

    private function logRepair($id,$mechanic,$customer, $vehicle, $scrap, $aluminium, $steel, $glass, $rubber, $total)
    {
        $repair = RepairLog::whereId($id)->first();
        $repair->mechanic = $mechanic;
        $repair->customer_name = $customer;
        $repair->vehicle = $vehicle;
        $repair->scrap_used = $scrap;
        $repair->alum_used = $aluminium;
        $repair->steel_used = $steel;
        $repair->rubber_used = $rubber;
        $repair->cost = $total;
        $repair->save();

        $mechanicName = User::whereId($mechanic)->select()->get();

        Http::post(Config('app.saleWebhook'), [
            "embeds"=> [
                [
                    "title"=> $mechanicName[0]->name." has logged a repair!",
                    "description"=> "See the repair details below:",
                    "color"=> 15358714,
                    "fields" =>
                        [
                            [
                                "name" => "Mechanic",
                                "value"=> $mechanicName[0]->name,
                                "inline" => false
                            ],
                            [
                                "name" => "Customer",
                                "value"=> empty($customer) ? "N/A" : $customer,
                                "inline" => true
                            ],
                            [
                                "name" => "Vehicle",
                                "value"=> empty($vehicle) ? "Not Set" : $vehicle,
                                "inline" => true
                            ],
                            [
                                "name" => "Scrap Used",
                                "value"=> $scrap,
                                "inline" => false
                            ],
                            [
                                "name" => "Aluminium Used",
                                "value"=> $aluminium,
                                "inline" => true
                            ],
                            [
                                "name" => "Steel Used",
                                "value"=> $steel,
                                "inline" => true
                            ],
                            [
                                "name" => "Glass Used",
                                "value"=> $glass,
                                "inline" => true
                            ],
                            [
                                "name" => "Rubber Used",
                                "value"=> $rubber,
                                "inline" => true
                            ],
                            [
                                "name" => "Total",
                                "value"=> "$".$total,
                                "inline" => false
                            ],
                        ],
                    "author"=> [
                        "name"=> Config('app.companyName')." Live Repair Logger"
                    ]
                ]
            ],
        ]);


    }

}
