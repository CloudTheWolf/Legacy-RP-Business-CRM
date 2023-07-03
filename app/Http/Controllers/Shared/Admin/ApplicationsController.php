<?php

namespace App\Http\Controllers\Shared\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\VgApplications;
use Illuminate\Support\Facades\Auth;


class ApplicationsController extends Controller
{

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->IsAdmin == 1) return $next($request);
            abort('401', "You don't have access to this page");
        });
    }

    public function Get()
    {
        switch(config('app.siteMode')){
            default:
                $applications = Applications::whereState('0')->get();
                break;
            case 'Arcade':
            case 'Bar':
            $applications = VgApplications::whereState('0')->get();
                break;
        }
        return view("Shared.Admin.applications",compact("applications"));
    }

    public function GetDone()
    {
        switch(config('app.siteMode')){
            default:
                $applications = Applications::whereState('1')->get();
                break;
            case 'Arcade':
            case 'Bar':
                $applications = VgApplications::whereState('1')->get();
                break;
        }
        return view("Shared.Admin.applications",compact("applications"));
    }


}
