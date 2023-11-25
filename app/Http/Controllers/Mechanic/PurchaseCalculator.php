<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PurchaseCalculator extends Controller
{
    public function index() : View
    {
        return view('mechanic.purchase-calculator');
    }
}
