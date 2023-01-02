<?php

namespace App\Http\Controllers\Mechanic\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MechanicSettings extends Controller
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
        return view('Mechanics.Admin.mechanic-settings');
    }

    public function Post(Request $request)
    {
        $this->updateSettings("scrap-buy",$request->get('scrap-buy'));
        $this->updateSettings("scrap-sell",$request->get('scrap-sell'));

        $this->updateSettings("aluminium-buy",$request->get('aluminium-buy'));
        $this->updateSettings("aluminium-sell",$request->get('aluminium-sell'));

        $this->updateSettings("steel-buy",$request->get('steel-buy'));
        $this->updateSettings("steel-sell",$request->get('steel-sell'));

        $this->updateSettings("steel-buy",$request->get('steel-buy'));
        $this->updateSettings("steel-sell",$request->get('steel-sell'));

        $this->updateSettings("glass-buy",$request->get('glass-buy'));
        $this->updateSettings("glass-sell",$request->get('glass-sell'));

        $this->updateSettings("rubber-buy",$request->get('rubber-buy'));
        $this->updateSettings("rubber-sell",$request->get('rubber-sell'));

        $this->updateSettings("adv-repair-kit-sell",$request->get('adv-repair-kit-sell'));


        return back()->with(["message" => "Success"]);
    }

    private function updateSettings($setting,$value)
    {
        $config = Configuration::whereName($setting)->first();
        $config->value = $value;
        $config->save();
    }

}
