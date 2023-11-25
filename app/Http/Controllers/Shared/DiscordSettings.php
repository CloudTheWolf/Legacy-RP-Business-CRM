<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscordSettings extends Controller
{
    public function index()
    {
        return view('shared.discord-settings');
    }
}
