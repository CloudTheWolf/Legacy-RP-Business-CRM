<?php

namespace App\Console\Commands;

use App\Models\Applications;
use App\Models\DiscordToken;
use App\Models\User;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class DiscordSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discord:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Discord';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $DISCORD_CLIENT_ID = Config::get('discord-auth.client_id');
        $DISCORD_CLIENT_SECRET = Config::get('discord-auth.client_secret');

        $guzzleClient = new GuzzleClient(['verify' => env('VERIFY_HTTPS', true)]);

        $tokensToRefresh = DiscordToken::get();

        foreach ($tokensToRefresh as $token) {
            $user = User::query()->whereDiscord($token->discord_id)->first();
            # Remove token if User exists and is disabled
            if(!is_null($user) && $user->disabled == 1)
            {
                print_r("$token->discord_id linked to disabled user $user->name");
                $token->delete();
                continue;
            }
            # Remove token if User does not exist or is disabled and has a handled application
            if(is_null($user) || $user->disabled == 1) {
                $handledApplication = Applications::query()->where("discordId", '=', $token->discord_id)->whereState(1)->first();
                if (!is_null($handledApplication)) {
                    print_r("$token->discord_id linked to handled application");
                    $token->delete();
                    continue;
                }
            }

            try {
                print_r("Refresh $token->discord_id\n");
                $response = $guzzleClient->post('https://discord.com/api/oauth2/token', [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'form_params' => [
                        'client_id' => $DISCORD_CLIENT_ID,
                        'client_secret' => $DISCORD_CLIENT_SECRET,
                        'grant_type' => 'refresh_token',
                        'refresh_token' => $token->refresh_token,
                    ],
                ]);

                $data = json_decode($response->getBody()->getContents(), true);

                $token->access_token = $data['access_token'];
                $token->refresh_token = $data['refresh_token'];
                $token->expires_at = now()->addSeconds($data['expires_in']);
                $token->save();

            } catch (\Exception $e) {
                echo("Failed to refresh token for Discord ID: {$token->discord_id}. Error: {$e->getMessage()}");
            }
        }
    }
}
