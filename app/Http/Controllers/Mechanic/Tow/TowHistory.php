<?php

namespace App\Http\Controllers\Mechanic\Tow;

use App\Http\Controllers\Controller;
use App\Models\CityTowLog;



class TowHistory extends Controller
{

    public function Get()
    {
        $towImpound = CityTowLog::selectRaw('`rowId`, `cityTowLogs`.`id`, `users`.`name`, `timestamp`, `modelName`, `reward`, `playerVehicle`, `plateNumber`')
            ->join('users','users.cid','=', 'cityTowLogs.characterId')->where('users.disabled','=','0')
            ->orderBy('timestamp','desc')
            ->paginate(25);
        return view('Mechanics.Tow.history', compact("towImpound"));
    }

}
