<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ActionController;

class CheckActive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Start');
        error_log('Some message here.');
        $users = DB::table('users')->where('onDuty','=','1')->get();
        foreach ($users as $user)
        {
            $name = $user->name;
            $id = $user->id;
            $client = new Client(['base_uri' => 'https://c3s1.cloudthewolf.com']);
            $response = $client->request('GET', '/op-framework/character.json?characterId='.$user->cid);
            $state = json_decode($response->getBody());
            if($state->statusCode == '404')
            {
                DB::table('users')
                    ->where('id',$id)
                    ->update([
                        'onDuty' => 0
                    ]);

                Http::post('https://discord.com/api/webhooks/908721593516187648/LiuMMnlnpUmjCa2kFqqNJ6pTfGYVdhvwALX4GLPjPJFQ1q_cBjELy0s30ObGQtG4caAC', [
                    "embeds"=> [
                        [
                            "title"=> $name." has been auto-clocked out",
                            "description"=> $name." has clocked out at ".now(),
                            "color"=> 15604751,
                            "author"=> [
                                "name"=> "Harmony Time Tracker"
                            ]
                        ]
                    ],
                ]);

            }
        }

    }
}
