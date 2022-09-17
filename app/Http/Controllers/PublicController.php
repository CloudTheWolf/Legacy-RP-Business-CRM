<?php

namespace App\Http\Controllers;

use App\Models\VgApplications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Session;

class PublicController extends Controller
{
    function applicationForm(Request $request)
    {
        if($request->input('steamID') == null)
        {
            return redirect('/apply');
        }
        $steamID = $request->input('steamID');
        $cid = $request->input('cid');
        $name = $request->input('name');
        $cell = $request->input('cell');
        return view('applicationForm',compact('cell','name','cid','steamID'));
    }

    function applicationFormArcade(Request $request)
    {
        if($request->input('steamID') == null)
        {
            return redirect('/apply');
        }
        $steamID = $request->input('steamID');
        $cid = $request->input('cid');
        $name = $request->input('name');
        $cell = $request->input('cell');
        return view('arcade.applicationForm',compact('cell','name','cid','steamID'));
    }

    function applicationFormAuth(Request $request)
    {
        return view('applicationFormAuth');
    }

    public function applicationFormProfile(Request $request)
    {
        if(Session::get('steamID') == null)
        {
            return redirect('/apply');
        }
        $user = Http::withToken(env('OP_FW_API_KEY'))->acceptJson()->get(env('OP_FW_REST_URI').'/characters/steam='.Session::get('steamID').'/data');
        $characters = json_decode($user->body())->data;
        return view('applicationFormCharList')->with('characters',$characters);
    }


    function applicationFormSubmit(Request $request)
    {
        $about = "My Timezone: {$request->input('timezone')}\n\n{$request->input('about')}";

        $application = new Applications();

        $application->name = $request->input('name');
        $application->discord = $request->input('discord');
        $application->steam = $request->input('steam');
        $application->cid = $request->input('cid');
        $application->cell = $request->input('cell');
        $application->about = $about;
        $application->why = $request->input('why');
        $application->record = $request->input('record');
        $application->gang =  $request->input('gang') == 1;
        $application->save();

        if(config('app.postJobApplications')) {
            $x = Http::post(env('DISCORD_JOB_WEBHOOK'), [
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
        return redirect(url('apply'))->with(['message' => "Application Submitted"]);

    }

    function arcadeApplicationFormSubmit(Request $request)
    {
        $vgAbout = "My Timezone: {$request->input('timezone')}\n\n{$request->input('about')}";

        $application = new VgApplications();

        $application->name = $request->input('name');
        $application->discord = $request->input('discord');
        $application->steam = $request->input('steam');
        $application->cid = $request->input('cid');
        $application->cell = $request->input('cell');
        $application->shift = $request->input('shift');
        $application->cityAge = $request->input('duration');
        $application->about = $vgAbout;
        $application->why = $request->input('why');
        $application->record = $request->input('record');
        $application->gang =  $request->input('gang') == 1;
        $application->save();

        return redirect(url('apply'))->with(['message' => "Application Submitted"]);

        // No Discord Required at this time

        /*
        if(config('app.postJobApplications')) {
            $x = Http::post(env('DISCORD_JOB_WEBHOOK'), [
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

    }


}
