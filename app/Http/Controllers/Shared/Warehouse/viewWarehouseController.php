<?php

namespace App\Http\Controllers\Shared\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Storage;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class viewWarehouseController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->IsAdmin == 1) return $next($request);
            abort('401', "You don't have access to this page");
        });
    }


    public function get(Request $request, $id){
        try {
            $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 60]);
            $response = $client->request('GET', '/op-framework/items.json');
            $items = json_decode($response->getBody());
        }
        catch (\Exception $e)
        {
            $items = json_decode('{"data":[]"}]');
        }
        $storage = Storage::whereId($id)->firstOrFail();
        return view('Shared.Warehouse.manage-warehouse',compact('storage','items'));
    }

}
