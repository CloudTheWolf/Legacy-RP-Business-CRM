<?php

namespace App\Http\Controllers\Bars\Sales;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\BarSales;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Specials;
use Illuminate\Support\Facades\Http;


class SalesLogger extends Controller
{
    public function Get()
    {
        try {
            $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 60]);
            $response = $client->request('GET', '/op-framework/vehicles.json');
            $vehicles = json_decode($response->getBody());
        }
        catch (\Exception $e)
        {
            $vehicles = json_decode('{"data":{"pdm":[],"edm":[],"addon":[]}}');
        }
        $latest = BarSales::whereStaff(Auth::user()->id)->orderByDesc("created_at")->limit(25)->get();
        $specials = Specials::all();
        $staff = User::whereDisabled('0')->get();
        $settings = Configuration::whereGroup("mechanic")->get();
        return view('BarClub.Sales.sale-logger',compact("vehicles","latest","staff","settings","specials"));
    }

    public function Post(Request $request)
    {
        $specialJson = $this->createSpecialJson($request);
        $this->logSale($request->input('staff'),$request->input('beer'),$request->input('cider'),
            $request->input('tequila'),$request->input('wine'),$request->input('vodka'),
            $request->input('absinthe'),$request->input('rum'),$request->input('whiskey'),$specialJson,$request->input('FinalCost'));
        return back()->with(['message' => "Log Added"]);
    }

    private function createSpecialJson(Request $request) : string
    {
        $specialItems = array();
        foreach ($request->except('_token','hidden','staff','mechanic','beer','cider','tequila','wine','vodka','absinthe','whiskey','rum','FinalCost') as $id => $value) {
            $specialItems[str_replace('sp_','',$id)] = $value;
        }
        return json_encode($specialItems);
    }

    private function logSale($staff,$beer, $cider, $tequila, $wine, $vodka, $absinthe, $rum,$whiskey,$specialJson, $total) : void
    {
        $sale = new BarSales();
        $sale->staff = $staff;
        $sale->beer = $beer;
        $sale->cider = $cider;
        $sale->tequila = $tequila;
        $sale->wine = $wine;
        $sale->vodka = $vodka;
        $sale->absinthe = $absinthe;
        $sale->rum = $rum;
        $sale->whiskey = $whiskey;
        $sale->specialJson = $specialJson;
        $sale->finalCost = $total;

        $sale->save();
    }

}
