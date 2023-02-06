<?php

namespace App\Http\Controllers\Arcade\Sales;

use App\Http\Controllers\Controller;
use App\Models\ArcadeSales;
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
        $latest = ArcadeSales::whereStaff(Auth::user()->id)->orderByDesc("created_at")->limit(25)->get();
        $specials = Specials::all();
        $staff = User::whereDisabled('0')->get();
        return view('Arcade.Sales.sale-logger',compact("latest","staff","specials"));
    }

    public function Post(Request $request)
    {
        $specialJson = $this->createSpecialJson($request);
        $this->logSale($request->input('staff'),$request->input('pizza'),$request->input('dog'),
            $request->input('nachos'),$request->input('waffle'),$request->input('water'),
            $request->input('coke'),$request->input('milk'),
            $request->input('beer'),$request->input('cider'),
            $request->input('tequila'),$request->input('wine'),$request->input('vodka'),
            $request->input('absinthe'),$request->input('rum'),$request->input('whiskey'),
            $request->input('zombie'),$request->input('arena'),
            $specialJson,$request->input('FinalCost'));
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

    private function logSale($staff,$pizza,$hotdog,$nacho,$waffle,$water,$coke,$milk,$beer, $cider, $tequila, $wine, $vodka, $absinthe, $rum,$whiskey,$zombie,$arena,$specialJson, $total) : void
    {
        $sale = new ArcadeSales();
        $sale->staff = $staff;

        $sale->pizza = $pizza;
        $sale->hotdog = $hotdog;
        $sale->nacho = $nacho;
        $sale->waffle = $waffle;

        $sale->water = $water;
        $sale->coke = $coke;
        $sale->milk = $milk;

        $sale->beer = $beer;
        $sale->cider = $cider;
        $sale->tequila = $tequila;
        $sale->wine = $wine;
        $sale->vodka = $vodka;
        $sale->absinthe = $absinthe;
        $sale->rum = $rum;
        $sale->whiskey = $whiskey;

        $sale->zombie = $zombie;
        $sale->arena = $arena;

        $sale->specialJson = $specialJson;
        $sale->finalCost = $total;

        $sale->save();
    }

}
