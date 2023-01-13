<?php

namespace App\Http\Controllers\Shared\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Specials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SpecialsController extends Controller
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
        $specials = Specials::all();
        return view('Shared.Admin.specials',compact('specials'));
    }

    public function Post(Request $request)
    {
        $special = new Specials();
        $special->name = $request->get('specialName');
        $special->price = $request->get('specialPrice');
        $special->deleted = false;
        $special->save();
        return back()->with(["message" => "Success"]);
    }

    public function Enable(Request $request,$id)
    {
        $special = Specials::whereId($id)->first();
        $special->deleted = false;
        $special->save();
        return back()->with(["message" => "Success"]);
    }

    public function Disable(Request $request,$id)
    {
        $special = Specials::whereId($id)->first();
        $special->deleted = true;
        $special->save();
        return back()->with(["message" => "Success"]);
    }


}
