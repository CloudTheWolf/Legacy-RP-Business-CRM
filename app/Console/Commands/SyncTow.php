<?php

namespace App\Console\Commands;

use App\Models\CityTowLog;
use App\Models\TowLog;
use App\Models\User;
use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncTow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:synctow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Tow Impounds';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if(config('app.siteMode') == "Mechanic")
        {
            $this->info("Starting City Impound Sync");
            $usersOnDuty = User::whereOnDuty(1)->get();
            $drivers = Http::withToken(env("OP_FW_API_KEY"))->acceptJson()->get(env("API_BASE_URI")."/op-framework/towImpounds.json")->json()["data"];
            var_dump($drivers);
            foreach ($drivers as $driver) {
                $this->info("Checking if [".$driver['characterId']."] works for us");
                $active = User::whereCid($driver['characterId'])->where('disabled','=',0)->count();
                if($active == 0) continue;
                foreach ($driver['towImpounds'] as $impound)
                {
                    $this->info("Add [".$impound['plateNumber']."] to log");
                    $newImpound = CityTowLog::whereId($impound['timestamp'])->firstOrNew();
                    $newImpound->id = $impound['timestamp'];
                    $newImpound->characterId = $driver['characterId'];
                    $newImpound->timestamp = Carbon::parse($impound['timestamp']);
                    $newImpound->modelName = $impound['modelName'];
                    $newImpound->reward = $impound['reward'];
                    $newImpound->playerVehicle = $impound['playerVehicle'];
                    $newImpound->plateNumber = $impound['plateNumber'];
                    $newImpound->saveOrFail();
                }
            }


        }
        else {
            $this->info("Site not in Mechanic Mode");
        }

        return Command::SUCCESS;
    }
}
