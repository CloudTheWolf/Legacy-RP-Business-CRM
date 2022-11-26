<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\BarSales;

class BarController extends BaseController
{
    function showBarSale()
    {
        $staff = DB::table('users')->where('disabled','=','0')->get();
        return view('bars.sales',compact('staff'));
    }

    function postBarSale(Request $request)
    {
        $this->saveBarSale($request);
        return back()->with('success','Success');
    }

    private function saveBarSale(Request $request)
    {
        $sale = new BarSales();
        $sale->staff = $request->get('mechanic');
        $sale->beer = $request->get('beer');
        $sale->cider = $request->get('cider');
        $sale->tequila = $request->get('tequila');
        $sale->wine = $request->get('wine');
        $sale->vodka = $request->get('vodka');
        $sale->absinthe = $request->get('absinthe');
        $sale->rum = $request->get('rum');
        $sale->whiskey = $request->get('whiskey');
        $sale->oiler = $request->get('oiler');
        $sale->finalCost = $request->get('FinalCost');

        $sale->save();

    }

}
