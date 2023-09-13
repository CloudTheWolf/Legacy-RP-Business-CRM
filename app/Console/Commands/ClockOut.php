<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ClockOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:clockout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clockout staff no longer in city';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if(Config("app.autoClockOut"))
        {
            $this->info("Starting Auto Clockout Process");
            $usersOnDuty = User::whereOnDuty(1)->get();
            $usersInCity = Http::withToken(env("OP_FW_API_KEY"))->acceptJson()->get(env("API_BASE_URI")."/op-framework/players.json")->json()["data"];

            foreach ($usersOnDuty as $user) {
                $this->info("Checking If ".$user->name." Is still in the city");
                $found = false;
                foreach ($usersInCity as $player)
                {
                    if(is_bool($player['character'])) continue;
                    if ($player['character']['fullName'] == $user->name)
                    {
                        $this->info("Found ".$user->name." in the city");
                        $found = true;
                        break;
                    }
                }

                if($found) continue;

                $hookObject = json_encode([
                    /*
                     * The username shown in the message
                     */
                    "username" => Config("app.companyName")." Time Tracker v2",
                    "tts" => false,

                    "embeds" => [
                        /*
                         * Our first embed
                         */
                        [
                            // Set the title for your embed
                            "title" =>  $user->name." has been clocked out.",

                            // The type of your embed, will ALWAYS be "rich"
                            "type" => "rich",

                            // A description for your embed
                            "description" => $user->name." has been auto-clock out as they are not in-city or flying in",

                            // The integer color to be used on the left side of the embed
                            "color" => hexdec( "FF0000" ),

                            // Author object
                            "author" => [
                                "name" => Config("app.companyName")." Time Tracker",
                            ],
                            "footer"=> [
                                "text" => "Developed By CloudTheWolf 🐺"
                            ]
                        ]
                    ]

                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

                Http::withBody($hookObject,"application/json")->post(Config("app.timesheetWebhook"));
                $user->onDuty = 0;
                $user->workingAs = "Off-Duty";
                $user->save();

                $workTime = WorkTime::whereCid($user->cid)->where("clockOutAt","=",null)->first();
                $workTime->clockOutAt = Carbon::now("utc");
                $workTime->save();

            }


        }


        return Command::SUCCESS;
    }
}
