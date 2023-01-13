<?php

namespace App\Http\Controllers\Bars\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BarSettings extends Controller
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
        return view('BarClub.Admin.bar-settings');
    }

    public function Post(Request $request)
    {
        $this->updateSettings("beer-sell",$request->get('beer-sell'));
        $this->updateSettings("cider-sell",$request->get('cider-sell'));
        $this->updateSettings("tequila-sell",$request->get('tequila-sell'));
        $this->updateSettings("wine-sell",$request->get('wine-sell'));
        $this->updateSettings("vodka-sell",$request->get('vodka-sell'));
        $this->updateSettings("absinthe-sell",$request->get('absinthe-sell'));
        $this->updateSettings("whiskey-sell",$request->get('whiskey-sell'));


        return back()->with(["message" => "Success"]);
    }

    private function updateSettings($setting,$value)
    {

        $config = Configuration::whereName($setting)->first();
        $config->value = $value;
        $config->save();
    }

}
