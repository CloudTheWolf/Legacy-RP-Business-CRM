<?php

namespace App\Console\Commands;

use App\Models\CityTowLog;
use App\Models\TowLog;
use App\Models\User;
use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncRepairs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staff:synctrepair';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Mechanic Repairs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if(config('app.siteMode') == "Mechanic")
        {
            $this->info("Starting City Repair Sync");
            $repairs = Http::withToken(env("OP_FW_API_KEY"))->acceptJson()->get(env("API_BASE_URI")."/op-framework/mechanicRepairs.json")->json()["data"];
            ///var_dump($repairs);
            foreach ($repairs as $repair) {
                $this->info("Checking if [".$repair['characterId']."] works for us");
                $active = User::whereCid($repair['characterId'])->where('disabled','=',0)->count();
                if($active == 0) continue;
                $items = $repair["vehicles"];
                foreach ($items as $item)
                {
                    echo($item['modelName']);
                    $timestamp = null;

                    if(array_key_exists('window',$item))
                    {
                        $timestamp = $item['window'][0]['timestamp'];
                    }
                    elseif(array_key_exists('wheel',$item))
                    {
                        $timestamp = $item['wheel'][0]['timestamp'];
                    }
                    elseif(array_key_exists('door',$item))
                    {
                        $timestamp = $item['door'][0]['timestamp'];
                    }
                    elseif(array_key_exists('engine',$item))
                    {
                        $timestamp = $item['engine'][0]['timestamp'];
                    }
                    elseif(array_key_exists('body',$item))
                    {
                        $timestamp = $item['body'][0]['timestamp'];
                    }
                }
            }


        }
        else {
            $this->info("Site not in Mechanic Mode");
        }

        return Command::SUCCESS;
    }
}
