<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationsList extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->IsAdmin == 0){
                abort(403,"You don't have access to this page");
            }
            return $next($request);
        });

    }
    public function index()
    {
        $applications = Applications::query()->whereState(0)->get();
        return view('shared.application-list',compact('applications'));
    }
}
