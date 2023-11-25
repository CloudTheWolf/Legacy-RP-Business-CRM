<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;

class RepairLogger extends Controller
{
    public function index()
    {

        return view('mechanic.repair-logger');
    }
}
