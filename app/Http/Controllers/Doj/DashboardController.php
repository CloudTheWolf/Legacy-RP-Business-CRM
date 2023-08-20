<?php

namespace App\Http\Controllers\Doj;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Get()
    {
        $onDutyList = [];
        return view('Doj.dashboard',compact("onDutyList"));
    }

}
