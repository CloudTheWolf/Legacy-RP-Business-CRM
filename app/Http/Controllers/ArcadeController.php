<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\ArcadeSales;

class ArcadeController extends BaseController
{
    function showArcadeSale()
    {
        $staff = DB::table('users')->where('disabled','=','0')->get();
        return view('arcade.sales',compact('staff'));
    }

    function postArcadeSale(Request $request)
    {
        $this->saveArcadeSale($request);
        return back()->with('success','Success');
    }

    private function saveArcadeSale(Request $request)
    {
        $sale = new ArcadeSales();
        $sale->staff = $request->get('mechanic');
        $sale->pizza = $request->get('pizza');
        $sale->hotdog = $request->get('hotdog');
        $sale->nacho = $request->get('nacho');
        $sale->waffle = $request->get('waffle');
        $sale->water = $request->get('water');
        $sale->coke = $request->get('coke');
        $sale->milk = $request->get('milk');
        $sale->beer = $request->get('beer');
        $sale->cider = $request->get('cider');
        $sale->tequila = $request->get('tequila');
        $sale->wine = $request->get('wine');
        $sale->vodka = $request->get('vodka');
        $sale->absinthe = $request->get('absinthe');
        $sale->rum = $request->get('rum');
        $sale->whiskey = $request->get('whiskey');
        $sale->zombie = $request->get('zombie');
        $sale->arena = $request->get('arena');
        $sale->arenaPizza = $request->get('app');
        $sale->lunchSpecial = $request->get('ls');
        $sale->fullPie = $request->get('fp');
        $sale->happyHour = $request->get('hh');
        $sale->mexicanWave = $request->get('mw');
        $sale->finalCost = $request->get('FinalCost');

        $sale->save();

    }

}
