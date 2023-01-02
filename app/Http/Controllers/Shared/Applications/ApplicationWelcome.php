<?php

namespace App\Http\Controllers\Shared\Applications;

use App\Http\Controllers\Controller;
use App\Models\RepairLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Shared\GetCityData;

class ApplicationWelcome extends Controller
{
    public function Get()
    {
        return view("Public.application-welcome");
    }



}
