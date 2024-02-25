<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class SyncAvatar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opfw:sync-avatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Avatar with city';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jobSearch = "";
        switch (config('app.siteMode'))
        {
            case "Mechanic":
                $jobSearch = "Los Santos Customs";
                break;
            default:
                return;
        }

        $this->info("Syncing Avatar Data With City");
        $players = Http::withToken(env("OP_FW_API_KEY"))->acceptJson()->withOptions(['verify' => false])->get(env("OP_FW_REST_URI")."/characters/job~".$jobSearch."/data")->json()["data"];

        foreach ($players as $player)
        {
            $user = User::query()->whereCid($player["character_id"]);
            if($user->count() == 0)
            {
                continue;
            }
            $this->info("Syncing [".$player["character_id"]."][".$player["first_name"]." ".$player["last_name"]."]");
            $user = $user->first();
            $user->avatar_url = $player["mugshot_url"];
            $user->towID = 0;
            try {
                $user->saveOrFail();
            } catch (Exception $e)
            {
                $this->info($e->getMessage());
            }

        }
    }
}
