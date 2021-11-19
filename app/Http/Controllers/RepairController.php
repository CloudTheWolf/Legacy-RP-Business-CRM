<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;


class RepairController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function repairForm()
    {

        $client = new Client(['base_uri' => env("API_BASE_URI")]);
        $response = $client->request('GET', '/op-framework/vehicles.json');
        $vehicles = json_decode($response->getBody());
        $latest = $this->getLatestRepairs();
        $mechanics = DB::table('users')->where('disabled','=','0')->get();
        return view('repair-log',)->with('vehicles',$vehicles)->with('latest',$latest)->with('mechanics',$mechanics);
    }

    function repairFormEdit(Request $request, $id)
    {

        $client = new Client(['base_uri' => env("API_BASE_URI")]);
        $response = $client->request('GET', '/op-framework/vehicles.json');
        $vehicles = json_decode($response->getBody());
        $latest = $this->getLatestRepairs();
        $mechanics = DB::table('users')->where('disabled','=','0')->get();
        $job = DB::table('repair_log')->where('id','=',$id)->first();
        return view('repair-log-edit')->with('vehicles',$vehicles)->with('latest',$latest)->with('mechanics',$mechanics)->with('job',$job);
    }

    function repairFormUpdate(Request $request)
    {
        $this->updateRepair($request->input('id'),$request->input('mechanic'),$request->input('customer'),$request->input('vehicle'),$request->input('scrap'),$request->input('aluminium'),$request->input('steel'),$request->input('glass'),$request->input('rubber'),$request->input('FinalCost'));
        return back()->with(['message' => "Log Edited"]);
    }

    function repairFormDelete(Request $request, $id)
    {
        DB::table('repair_log')
            ->where('id','=',$id)
            ->update([
                'deleted' => '1',
            ]);
        return back()->with(['message' => "Log Deleted"]);
    }

    function repairFormUnDelete(Request $request, $id)
    {
        DB::table('repair_log')
            ->where('id','=',$id)
            ->update([
                'deleted' => '0',
            ]);
        return back()->with(['message' => "Log Deleted"]);
    }

    function repairFormLog(Request $request)
    {
        $this->logRepair($request->input('mechanic'),$request->input('customer'),$request->input('vehicle'),$request->input('scrap'),$request->input('aluminium'),$request->input('steel'),$request->input('glass'),$request->input('rubber'),$request->input('FinalCost'));
        return back()->with(['message' => "Log Added"]);
    }

    private function logRepair($mechanic,$customer, $vehicle, $scrap, $aluminium, $steel, $glass, $rubber, $total)
    {
        DB::table('repair_log')->insert([
            'mechanic' => $mechanic,
            'customer_name' => $customer,
            'vehicle' => $vehicle,
            'scrap_used' => $scrap,
            'alum_used' => $aluminium,
            'steel_used' => $steel,
            'glass_used' => $glass,
            'rubber_used' => $rubber,
            'cost' => $total,

        ]);
    }

    private function updateRepair($id,$mechanic,$customer, $vehicle, $scrap, $aluminium, $steel, $glass, $rubber, $total)
    {
        DB::table('repair_log')
            ->where('id','=',$id)
            ->update([
            'mechanic' => $mechanic,
            'customer_name' => $customer,
            'vehicle' => $vehicle,
            'scrap_used' => $scrap,
            'alum_used' => $aluminium,
            'steel_used' => $steel,
            'glass_used' => $glass,
            'rubber_used' => $rubber,
            'cost' => $total,
        ]);
    }

    function getBuyTemplate()
    {
        $matts = DB::table('buyTemplate')
                    ->where('userId',Auth::id())
                    ->get()
                    ->first();

        return view('buying')->with('matts',$matts);
    }

    function saveBuyTemplate(Request $request)
    {
        DB::table('buyTemplate')
            ->where('userId',Auth::id())
            ->update(['scrap' => $request->input('scrap'), 'alum' => $request->input('aluminium'),
            'steel' => $request->input('steel'),'glass' => $request->input('glass'),'rubber' => $request->input('rubber')]);

        return back()->with(['message' => "Saved"]);
    }


    function repairLog()
    {

        $latest = $this->getAllRepairs();
        return view('repair-log-full',)->with('latest',$latest);
    }

    private function getLatestRepairs()
    {
        return DB::table('repair_log')
            ->where('deleted','=','0')
            ->join('users', 'users.id','=','repair_log.mechanic')
            ->select('repair_log.id', 'users.name', 'repair_log.customer_name', 'repair_log.vehicle', 'repair_log.scrap_used', 'repair_log.alum_used', 'repair_log.steel_used', 'repair_log.glass_used', 'repair_log.rubber_used', 'repair_log.cost', 'repair_log.timestamp')
            ->limit(25)
            ->orderByDesc('repair_log.timestamp')
            ->get();
    }

    private function getAllRepairs()
    {
        return DB::table('repair_log')
            ->where('deleted','=','0')
            ->join('users', 'users.id','=','repair_log.mechanic')
            ->select('repair_log.id', 'users.name', 'repair_log.customer_name', 'repair_log.vehicle', 'repair_log.scrap_used', 'repair_log.alum_used', 'repair_log.steel_used', 'repair_log.glass_used', 'repair_log.rubber_used', 'repair_log.cost', 'repair_log.timestamp')
            ->orderByDesc('repair_log.timestamp')
            ->get();
    }

}
