<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SiteSettings extends Controller
{
    public function index()
    {
        return view('shared.site-settings');
    }
}
