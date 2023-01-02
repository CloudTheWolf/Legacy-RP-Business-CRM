<?php

namespace App\Http\Controllers\Arcade;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Shared\GetCityData;
use App\Models\User;

class DashboardController extends Controller
{

    public function Get()
    {
        // Get Current On Duty
        $onDuty = User::whereOnDuty('1')->count();
        $onDutyList = User::whereOnDuty('1')->select(["name","workingAs"])->get();

        //Get In City Count
        $citizens = GetCityData::GetInCityCount();
    }

}
