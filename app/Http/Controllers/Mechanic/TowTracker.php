<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;


class TowTracker extends Controller
{
    public function index()
    {
        return view ('mechanic.tow-tracker');
    }
}
