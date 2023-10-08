<?php

namespace App\Jobs;

use App\Models\DiscordToken;
use GuzzleHttp\Client;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class RefreshDiscordTokens implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private mixed $DISCORD_CLIENT_ID;
    private mixed $DISCORD_CLIENT_SECRET;

    protected GuzzleClient $guzzleClient;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->DISCORD_CLIENT_ID = Config::get('discord-auth.client_id');
        $this->DISCORD_CLIENT_SECRET = Config::get('discord-auth.client_secret');

        $this->guzzleClient = new GuzzleClient(['verify' => env('VERIFY_HTTPS',true)]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tokensToRefresh = DiscordToken::where('expires_at', '<=', now()->addHours(24))->get();


        foreach ($tokensToRefresh as $token) {
            try {
                $response = $this->guzzleClient->post('https://discord.com/api/oauth2/token', [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'form_params' => [
                        'client_id' => env('DISCORD_CLIENT_ID'),
                        'client_secret' => env('DISCORD_CLIENT_SECRET'),
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
                Log::error("Failed to refresh token for Discord ID: {$token->discord_id}. Error: {$e->getMessage()}");
            }
        }
    }
}
