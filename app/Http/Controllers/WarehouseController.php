<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\StorageLog;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function AddWarehouseEntry(Request $request, $id)
    {
        if($request->to == null) return back()->with('Error','Invalid Submission, No "Issue To" Specified');
        $warehouse = Storage::query()->where('id','=',$id)->firstOrFail();
        if($request->to == 0)
        {
            $scrapIn = ($request->scrap * 5) + $warehouse->scrap;
            $aluminiumIn = ($request->aluminium * 5) + $warehouse->aluminium;
            $steelIn = ($request->steel * 5) + $warehouse->steel;
            $glassIn = ($request->glass * 5) + $warehouse->glass;
            $rubberIn = ($request->rubber * 2) + $warehouse->rubber;
            $totalWeight = $scrapIn + $aluminiumIn + $steelIn + $glassIn + $rubberIn;
            if($totalWeight > $warehouse->capacity)
            {
                return back()->with('Error','Material Capacity ('.$totalWeight.') Exceeds Warehouse Capacity of'.$warehouse->capacity);
            }
            $warehouse->scrap = $scrapIn;
            $warehouse->aluminium = $aluminiumIn;
            $warehouse->steel = $steelIn;
            $warehouse->glass = $glassIn;
            $warehouse->rubber = $rubberIn;
            $warehouse->saveOrFail();
            $log = new StorageLog();
            $log->storageId = $id;
            $log->scrap = $request->scrap;
            $log->aluminium = $request->aluminium;
            $log->steel = $request->steel;
            $log->glass = $request->glass;
            $log->rubber = $request->rubber;
            $log->issuedTo = $request->to;
            $log->issuer = $request->from;
            $log->saveOrFail();
            return back()->with('Success','Warehouse Updated');
        }


        $scrapOut = $warehouse->scrap - ($request->scrap * 5);
        $aluminiumOut = $warehouse->aluminium - ($request->aluminium * 5);
        $steelOut = $warehouse->steel - ($request->steel * 5);
        $glassOut = $warehouse->glass - ($request->glass * 5);
        $rubberOut = $warehouse->rubber - ($request->rubber * 2);
        $totalWeightOut = $scrapOut + $aluminiumOut + $steelOut + $glassOut + $rubberOut;
        if($scrapOut < 0 || $aluminiumOut < 0 || $steelOut < 0 || $glassOut < 0 || $rubberOut < 0 || $totalWeightOut < 0)
        {
            return back()->with('Error','One or more items would have gone into negatives.');
        }
        $warehouse->scrap = $scrapOut;
        $warehouse->aluminium = $aluminiumOut;
        $warehouse->steel = $steelOut;
        $warehouse->glass = $glassOut;
        $warehouse->rubber = $rubberOut;
        $warehouse->saveOrFail();
        $log = new StorageLog();
        $log->storageId = $id;
        $log->scrap = $request->scrap;
        $log->aluminium = $request->aluminium;
        $log->steel = $request->steel;
        $log->glass = $request->glass;
        $log->rubber = $request->rubber;
        $log->issuedTo = $request->to;
        $log->issuer = $request->from;
        $log->saveOrFail();
        return back()->with('Success','Warehouse Updated');


    }

    function viewWarehouse($id)
    {
        $logs = StorageLog::query()->where('storageId','=',$id)->get();
        $users = User::query()->where('disabled','=','0')->get();
        $warehouse = Storage::query()->where('id','=',$id)->firstOrFail();
        return view('warehouse',compact('logs','warehouse','users'));
    }

    public function ViewAllStorage()
    {
        $warehouses = Storage::all();
        return view('all-storage')->with('warehouses',$warehouses);
    }

    function AddNewStorage(Request $request)
    {
        $warehouse = new Storage();
        $warehouse->name = $request->warehouseName;
        $warehouse->capacity = $request->warehouseCapacity;
        $warehouse->scrap = 0;
        $warehouse->aluminium = 0;
        $warehouse->steel = 0;
        $warehouse->glass = 0;
        $warehouse->rubber = 0;
        $warehouse->saveOrFail();

        return redirect(url('/warehouse/'.$warehouse->id));
    }

}
