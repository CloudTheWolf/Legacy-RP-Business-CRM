<?php

namespace App\Http\Controllers\Arcade\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArcadeSettings extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->IsAdmin != 1) abort('401', "You don't have access to this page");
            return $next($request);
        });
    }

    public function Get()
    {
        return view('Arcade.Admin.arcade-settings');
    }

    public function Post(Request $request)
    {
        // Save Drinks
        $this->updateSettings("beer-sell",$request->get('beer-sell'));
        $this->updateSettings("cider-sell",$request->get('cider-sell'));
        $this->updateSettings("tequila-sell",$request->get('tequila-sell'));
        $this->updateSettings("wine-sell",$request->get('wine-sell'));
        $this->updateSettings("vodka-sell",$request->get('vodka-sell'));
        $this->updateSettings("absinthe-sell",$request->get('absinthe-sell'));
        $this->updateSettings("whiskey-sell",$request->get('whiskey-sell'));
        $this->updateSettings("rum-sell",$request->get('rum-sell'));
        $this->updateSettings("coke-sell",$request->get('coke-sell'));
        $this->updateSettings("water-sell",$request->get('water-sell'));
        $this->updateSettings("milk-sell",$request->get('milk-sell'));
        // Save Food
        $this->updateSettings("pizza-sell",$request->get('pizza-sell'));
        $this->updateSettings("dog-sell",$request->get('dog-sell'));
        $this->updateSettings("nachos-sell",$request->get('nachos-sell'));
        $this->updateSettings("waffle-sell",$request->get('waffle-sell'));
        //Save VR
        $this->updateSettings("zombie-sell",$request->get('zombie-sell'));
        $this->updateSettings("arena-sell",$request->get('arena-sell'));

        return back()->with(["message" => "Success"]);
    }

    private function updateSettings($setting,$value)
    {

        $config = Configuration::whereName($setting)->firstOrNew();
        $config->name = $setting;
        $config->value = $value;
        $config->group = "foodDrink";
        $config->save();
    }

}
