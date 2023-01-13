<?php

namespace App\Http\Controllers\Shared\Applications;

use App\Http\Controllers\Controller;
use App\Models\VgApplications;
use App\Models\RepairLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Shared\GetCityData;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class BarApplication extends Controller
{
    public function Post(Request $request)
    {
        $about = "My Timezone: {$request->input('timezone')}\n\n{$request->input('about')}";

        $vgApplication = new VgApplications();

        $vgApplication->name = $request->input('name');
        $vgApplication->discord = $request->input('discord');
        $vgApplication->steam = $request->input('steam');
        $vgApplication->cid = $request->input('cid');
        $vgApplication->cell = $request->input('cell');
        $vgApplication->about = $about;
        $vgApplication->why = $request->input('why');
        $vgApplication->record = $request->input('record');
        $vgApplication->gang =  $request->input('gang') == 1;
        $vgApplication->cityAge = $request->input('duration');
        $vgApplication->shift = $request->input('shift');
        $vgApplication->save();

        /*
        if(config('app.postJobApplications')) {
            $x = Http::post(config('app.jobWebhook'), [
                "username" => "Application From: " . $request->input('name'),
                "embeds" => [
                    [
                        "title" => "New Job Application",
                        "description" => "A new job application has been submitted",
                        "color" => 15358714,
                        "fields" =>
                            [
                                [
                                    "name" => "Name",
                                    "value" => $request->input('name'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Discord",
                                    "value" => $request->input('discord'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Passport (Steam) ID",
                                    "value" => $request->input('steam'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "CID",
                                    "value" => $request->input('cid'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Cell Phone",
                                    "value" => $request->input('cell'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Tell us a little about yourself",
                                    "value" => $about,
                                    "inline" => false
                                ],
                                [
                                    "name" => "Tell us why you want a job at " . env("COMPANY_NAME") . " and why we should hire you!",
                                    "value" => $request->input('why'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Tell us about your Criminal Record",
                                    "value" => $request->input('record'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Do you have any gang ties, or affiliations that may affect your employment?",
                                    "value" => $request->input('gang') == 1 ? "Yes" : "No",
                                    "inline" => false
                                ],
                            ],
                        "author" => [
                            "name" => env('COMPANY_NAME') . " HR Department"
                        ]
                    ]
                ],
                "components" => [
                    [
                        "type" => 1,
                        "components"=> [
                            [
                                "type" => 2,
                                "style" => 5,
                                //"custom_id" => "click_one",
                                "label" => "View Application",
                                "url" => url(env('app_url') . "/admin/applications/". $application->id),
                            ]
                        ]
                    ]
                ] ,
            ]);
        }
        */
        return redirect(url('apply'))->with(['message' => "Application Submitted"]);
    }



}
