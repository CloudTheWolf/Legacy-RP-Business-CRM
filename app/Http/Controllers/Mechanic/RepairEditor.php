<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;

class RepairEditor extends Controller
{
    public function index($id)
    {
        return view('mechanic.repair-editor',compact('id'));
    }
}
