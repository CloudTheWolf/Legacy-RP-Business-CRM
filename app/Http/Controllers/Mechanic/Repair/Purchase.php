<?php

namespace App\Http\Controllers\Mechanic\Repair;

use App\Http\Controllers\Controller;
use App\Models\BuyTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Purchase extends Controller
{

    public function Get()
    {
        $matts = BuyTemplate::whereUserId(Auth::id())->first();
        return view('Mechanics.Repair.buying',compact("matts"));
    }

    public function Post(Request $request)
    {
        $buy = BuyTemplate::whereUserId(Auth::id())->firstOrNew();
        $buy->scrap = $request->get('scrap');
        $buy->alum = $request->get('aluminium');
        $buy->steel = $request->get('steel');
        $buy->glass = $request->get('glass');
        $buy->rubber = $request->get('rubber');
        $buy->save();
        return back()->with(['message' => "Saved"]);
    }

}
