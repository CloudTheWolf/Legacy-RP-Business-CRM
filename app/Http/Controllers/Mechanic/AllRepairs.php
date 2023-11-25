<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllRepairs extends Controller
{
    public function index()
    {
        return view ('mechanic.all-repairs');
    }
}
