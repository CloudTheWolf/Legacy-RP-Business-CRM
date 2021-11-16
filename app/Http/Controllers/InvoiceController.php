<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InvoiceController extends Controller
{
    function viewInvoice(Request $request, $id,$cost)
    {
        $repair = $this->getRepair($id);
        if($cost != $repair[0]->cost)
        {
            return App::abort(404);
        }
        return view('app-invoice',)->with('repair',$repair);
    }

    private function getRepair($id)
    {
        return DB::select('SELECT `repair_log`.`id`, `users`.`name`, `customer_name`, `vehicle`, `scrap_used`, `alum_used`, `steel_used`, `glass_used`, `rubber_used`, `cost`, `timestamp` FROM `repair_log` inner join users on users.id = repair_log.mechanic WHERE `repair_log`.`id` = ? ORDER BY `repair_log`.`timestamp` DESC LIMIT 1', [$id]);
    }

}
