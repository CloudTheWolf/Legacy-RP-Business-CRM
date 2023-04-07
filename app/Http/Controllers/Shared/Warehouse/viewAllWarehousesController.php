<?php

namespace App\Http\Controllers\Shared\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class viewAllWarehousesController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->IsAdmin == 1) return $next($request);
            abort('401', "You don't have access to this page");
        });
    }


    public function get(){
        $allStorageLocations = Storage::all();
        return view('Shared.Warehouse.manage-warehouses',compact('allStorageLocations'));
    }

}
