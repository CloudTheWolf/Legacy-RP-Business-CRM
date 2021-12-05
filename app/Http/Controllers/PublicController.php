<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class PublicController extends Controller
{
    function applicationForm(Request $request)
    {
        return view('applicationForm');
    }

    function applicationFormSubmit(Request $request)
    {

        DB::table('applications')->insert(
            [
                "name" => $request->input('name'),
                "discord" => $request->input('discord'),
                "steam" => $request->input('steam'),
                "cid" => $request->input('cid'),
                "cell" => $request->input('cell'),
                "about" => $request->input('about'),
                "why" => $request->input('why'),
                "record" => $request->input('record'),
                "gang" => $request->input('gang') == 1
            ]
        );

        Http::post(env('DISCORD_JOB_WEBHOOK'), [
            "embeds"=> [
                [
                    "title"=> "New Job Application",
                    "description"=> "A new job application has been submitted",
                    "color"=> 15358714,
                    "fields" =>
                    [
                      [
                          "name" => "Name",
                          "value"=> $request->input('name'),
                          "inline" => false
                      ],
                        [
                            "name" => "Discord",
                            "value"=> $request->input('discord'),
                            "inline" => false
                        ],
                        [
                            "name" => "Password (Steam) ID",
                            "value"=> $request->input('steam'),
                            "inline" => false
                        ],
                        [
                            "name" => "CID",
                            "value"=> $request->input('cid'),
                            "inline" => false
                        ],
                        [
                            "name" => "Cell Phone",
                            "value"=> $request->input('cell'),
                            "inline" => false
                        ],
                        [
                            "name" => "Tell us a little about yourself",
                            "value"=> $request->input('about'),
                            "inline" => false
                        ],
                        [
                            "name" => "Tell us why you want a job at Harmony and why we should hire you!",
                            "value"=> $request->input('why'),
                            "inline" => false
                        ],
                        [
                            "name" => "Tell us about your Criminal Record",
                            "value"=> $request->input('record'),
                            "inline" => false
                        ],
                        [
                            "name" => "Do you have any gang ties, or affiliations that may affect your employment?",
                            "value"=> $request->input('gang') == 1 ? "Yes" : "No",
                            "inline" => false
                        ],
                    ],
                    "author"=> [
                        "name"=> env('COMPANY_NAME')." HR Department"
                    ]
                ]
            ],
        ]);

        return redirect(url('apply'))->with(['message' => "Application Submitted"]);

    }


}
