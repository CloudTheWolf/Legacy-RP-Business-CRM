<?php

namespace App\Http\Controllers\Shared\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use App\Models\Configuration;
use App\Models\DiscordToken;
use App\Models\User;
use App\Models\VgApplications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;


class ApplicationController extends Controller
{

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->IsAdmin == 1) return $next($request);
            abort('401', "You don't have access to this page");
        });
    }


    public function Get(Request $request, $id)
    {
        switch(config('app.siteMode')){
            default:
                $application = Applications::whereId($id)->firstOrFail();
                break;
            case 'Arcade':
            case 'Bar':
                $application = VgApplications::whereId($id)->firstOrFail();
                break;
        }

        return view("Shared.Admin.application",compact("application"));
    }

    public function Post(Request $request)
    {
        if($request->input('ack') == 'accept') {

            if($request->input('discordId') != null) {
                $this->AddToDiscord($request->input('discordId'));
            }
            $password = Hash::make($request->input('cell'));
            $user = User::firstOrNew(['cid' => $request->input('cid')]);
            $user->password = $password;
            $user->name = $request->input('name');
            $user->email = $request->input('username');
            $user->cell = $request->input('cell');
            $user->role = $request->input('role');
            $user->cid = $request->input('cid');
            $user->steamId = $request->input('steamId');
            $user->discord = $request->input('discordId');
            $user->disabled = 0;
            if ($request->role == "Boss" || $request->role == "Veteran Manager" || $request->role == "Manager") {
                $user->isAdmin = 1;
            } else {
                $user->isAdmin = 0;
            }

            $user->save();
        }
        switch(config('app.siteMode')){
            default:
                $application = Applications::where('id', '=', $request->id)->first();
                break;
            case 'Arcade':
            case 'Bar':
                $application = VgApplications::where('id', '=', $request->id)->first();
                break;
        }
        $application->state = 1;
        $application->save();

        return redirect('/admin/applications')->with('message',"User Created/Updated");
    }

    private function AddToDiscord($discordId)
    {

            $auth = DiscordToken::whereDiscordId($discordId)->firstOrFail();
            $userAccessToken = $auth->access_token;
            $guildId = config('app.guild');
            if (strlen($guildId) == 0) return;
            $client = new Client([
                'base_uri' => 'https://discord.com/api/v10/',
                'verify' => env('VERIFY_HTTPS', false)
            ]);
            $response = $client->put("guilds/{$guildId}/members/{$discordId}", [
                'headers' => [
                    'Authorization' => 'Bot ' . config('discord-auth.bot_token'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'access_token' => $userAccessToken,
                ],
            ]);
            json_decode($response->getBody()->getContents(), true);

    }

}
