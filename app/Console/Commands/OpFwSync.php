<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpFwSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opfw:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->SyncTowImpoinds();
        $this->SyncCitizens();
         return 0;
    }

    private function SyncTowImpoinds()
    {
        $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 5]);
        $response = $client->request('GET', '/op-framework/towImpounds.json');
        $data = json_decode($response->getBody());
        //echo($data->data[0]->characterId);
        foreach ($data->data as $impound)
        {
            $isUser = DB::table('users')->where('cid','=',$impound->characterId)->count();
            if($isUser == 0)
            {
                //echo($impound->characterId.' Is not staff... will skip');
                $this->info($impound->characterId.' Is not staff... will skip');
                continue;
            }
            $this->info($impound->characterId.' Log Started');
            foreach ($impound->towImpounds as $log)
            {
                DB::table('cityTowLogs')->updateOrInsert(
                    ['id' => $log->timestamp, 'characterId' => $impound->characterId],
                    ['timestamp'=>date('Y-m-d H:i:s',$log->timestamp),'modelName'=>$log->modelName,'reward'=>$log->reward,'playerVehicle'=>$log->playerVehicle,'plateNumber'=>$log->plateNumber]
                );
            }
        }
    }

    private function SyncCitizens()
    {
        $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 5]);
        $response = $client->request('GET', '/op-framework/users.json');
        $users = json_decode($response->getBody());
        foreach ($users->data as $user)
        {
            if($user->character === false)
            {
                echo($user->steamIdentifier.' has no character loaded.');
                continue;
            }
            echo('Loading '.$user->character->fullName);
            DB::table('citizens')->updateOrInsert(
                ['id' => $user->character->id],
                ['name'=>$user->character->fullName, 'passport' => $user->steamIdentifier]
            );
        }

    }

    public function SyncCitizen($cid)
    {
        return json_decode(Http::withToken(env("OP_FW_API_KEY"))->get(env("OP_FW_REST_URI") . '/characters/id='.$cid.'/data'))->data[0];
    }



}
