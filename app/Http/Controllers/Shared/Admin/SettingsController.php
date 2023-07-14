<?php

namespace App\Http\Controllers\Shared\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
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
        return view('Shared.Admin.settings');
    }

    public function Post(Request $request)
    {

        // Site Settings
        $this->updateSettings('APP_NAME',$request->get('app-name'));
        $this->updateSettings('companyName',$request->get('company-name'));
        $this->updateSettings('brandingPath',$request->get('branding-dir'));
        $this->updateSettings('siteMode',$request->get('site-mode'));

        //Discord Settings
        $this->updateSettings('postJobApplications',$request->get('post-job'));
        $this->updateSettings('jobWebhook',$request->get('job-discord'));

        if($request->has('timesheet-discord'))
        {
            $val = $request->get('timesheet-discord') == null ? '' : $request->get('timesheet-discord');
            $this->updateSettings('timesheetWebhook',$val);
        }
        else
        {
            $this->updateSettings('timesheetWebhook',"");
        }



        $this->updateSettings('autoClockOut',$request->get('auto-clockout'));

        if($request->get('site-mode') == "Mechanic") {

            $this->updateSettings('saleWebhook', $request->get('sale-discord'));
            $this->updateSettings('towWebhook', $request->get('tow-discord'));
        }

        $this->updateSettings('botName',$request->get('botName'));

        return back()->with(['message' => 'Settings Saved']);
    }

    private function updateSettings($setting,$value)
    {
        if($value == null) {
            return;
            //dd($setting);
        }
        $config = Configuration::whereName($setting)->first();
        $config->value = $value;
        $config->save();
    }
}
