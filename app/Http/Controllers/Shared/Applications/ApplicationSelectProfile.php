<?php

namespace App\Http\Controllers\Shared\Applications;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;

class ApplicationSelectProfile extends Controller
{
    public function Get(Request $request)
    {

        if(Session::get('discordId') == null)
        {
            return redirect('/apply');
        }
        $steamId = Session::get('steamID');
        $discordId = Session::get('discordId');
        $discordName = Session::get('discordUsername');
        $discordDiscriminator = Session::get('discordDiscriminator');
        if($discordDiscriminator != '0')
        {
            $discordName = "$discordName#$discordDiscriminator";
        }
        return view('Public.application-select-character',compact('steamId','discordName','discordId'));
    }

    public function Post(Request $request)
    {
        if($request->input('cid') == null)
        {
            return redirect('/apply');
        }

        try {
            $client = new Client(['base_uri' => Config('app.mdtUrl'), 'timeout' => 60]);
            $headers = ['Accept' => 'application/json'];
            $response = $client->request('GET', '/arrests/' . $request->input('cid'), $headers);
            $arrestData = json_decode($response->getBody(), true);
            $lastArrest = array_key_exists('lastArrestedDate', $arrestData) ?
                Carbon::parse($arrestData['lastArrestedDate'])->format("l F dS Y") . " at " .
                Carbon::parse($arrestData['lastArrestedDate'])->format("h:i A") . " (UTC) for..." : "Never";
        }
        catch(GuzzleException $e)
        {
            Log::warning($e->getMessage());
            $lastArrest = "{{Error getting information from MDT, Please manually put details here.}}";
        }
        $user = Http::withToken(env('OP_FW_API_KEY'))->acceptJson()->withoutVerifying() ->get(env('OP_FW_REST_URI').'/characters/id='.$request->input('cid') .'/data')->json('data')[0];
        $discordName = $request->input('discordName');
        $discordId = $request->input('discordId');
        $steamID = $request->input('steamId');
        $cid = $request->input('cid');
        $name = $user["first_name"] . " " . $user["last_name"];
        $cell = $user["phone_number"];
        if(config('app.siteMode') == "Bar" || config('app.siteMode') == "Arcade")
        {
            return view('Public.vg-application-form',compact('cell','name','cid','steamID','lastArrest','discordName','discordId'));
        }
        return view('Mechanics.Public.application-form',compact('cell','name','cid','steamID','lastArrest','discordName','discordId'));
    }


}
