<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\DiscordRole;
use App\Models\DiscordToken;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApplicationsView extends Controller
{
    public function index($id)
    {
        return view('mechanic.application-view',compact('id'));
    }

    public function post(Request $request, $id)
    {
        $application = Applications::whereId($id)->first();
        $password = Hash::make($application->cell);
        $user = User::query()->whereCid($application->cid)->firstOrNew();
        $user->name = $application->name;
        $user->email = $request->input('email');
        $user->cell = $application->cell;
        $user->cid = $application->cid;
        $user->role = $request->input('role');
        $user->discord = $application->discordId;
        $user->steamId = $application->steam;
        $user->disabled = 0;
        if ($request->input('role') == "Boss" || $request->input('role') == "Veteran Manager" || $request->input('role') == "Manager") {
            $user->isAdmin = 1;
        } else {
            $user->isAdmin = 0;
        }
        $user->password = $password;
        $user->save();
        $application->state = 1;
        $application->save();
        if($application->discordId != null) {
            $auth = DiscordToken::whereDiscordId($application->discordId)->firstOrFail();
            $userAccessToken = $auth->access_token;
            $guildId = config('app.guild');
            if (strlen($guildId) == 0) return redirect()->route('admin-pending-applications');
            $client = new Client([
                'base_uri' => 'https://discord.com/api/v10/',
                'verify' => env('VERIFY_HTTPS', false)
            ]);
            $joined = $client->put("guilds/{$guildId}/members/{$application->discordId}", [
                'headers' => [
                    'Authorization' => 'Bot ' . config('discord-auth.bot_token'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'access_token' => $userAccessToken,
                ],
            ]);

            if ($joined->getStatusCode() == 204 || $joined->getStatusCode() == 201) {

                $jsonBody = [
                    'headers' => [
                        'Authorization' => 'Bot ' . config('discord-auth.bot_token'),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'nick' => $application->name
                    ]
                ];

                $staffRole = DiscordRole::whereRoleName('Staff');
                if (!$staffRole->count() == 0 || !is_null($staffRole->first()->role_id)) {
                    $jsonBody['json']['roles'][] = $staffRole->first()->role_id;
                }

                $jobRole = DiscordRole::whereRoleName($request->input('role'));
                if (!$jobRole->count() == 0 || !is_null($jobRole->first()->role_id)) {
                    $jsonBody['json']['roles'][] = $jobRole->first()->role_id;
                }

                $client->patch("guilds/{$guildId}/members/{$application->discordId}", $jsonBody);
            }
        }
        return redirect()->route('admin-pending-applications');
    }
}
