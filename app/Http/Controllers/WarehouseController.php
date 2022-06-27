<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WarehouseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function ManageStorage()
    {

    }

    function StorageLog(Request $request)
    {

    }

    public function ViewAllStorage()
    {
        $warehouses = DB::table('storage')->get();
        return view('all-storage')->with('warehouses',$warehouses);
    }

    function AddNewStorage(Request $request)
    {

    }

}
