<?php

namespace App\Http\Controllers\Shared\Applications;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ApplicationSelectProfile extends Controller
{
    public function Get(Request $request)
    {
        if(Session::get('steamID') == null)
        {
            return redirect('/apply');
        }
        $steamId = Session::get('steamID');
        return view('Public.application-select-character',compact('steamId'));
    }

    public function Post(Request $request)
    {
        if($request->input('cid') == null)
        {
            return redirect('/apply');
        }
        $client = new Client(['base_uri' =>Config('app.mdtUrl'),'timeout' => 60]);
        $headers = ['Accept' => 'application/json'];
        $response = $client->request('GET','/arrests/'.$request->input('cid'),$headers);
        //$request = new Request('GET', $url, $headers);
        $arrestData = json_decode($response->getBody(),true);
        $lastArrest = array_key_exists('lastArrestedDate',$arrestData) ?
            Carbon::parse($arrestData['lastArrestedDate'])->format("l F dS Y") . " at " .
            Carbon::parse($arrestData['lastArrestedDate'])->format("h:i A") . " (UTC) for..." : "Never";
        $user = Http::withToken(env('OP_FW_API_KEY'))->acceptJson()->get(env('OP_FW_REST_URI').'/characters/id='.$request->input('cid') .'/data')->json('data')[0];
        $steamID = $request->input('steamId');
        $cid = $request->input('cid');
        $name = $user["first_name"] . " " . $user["last_name"];
        $cell = $user["phone_number"];
        return view('Mechanics.Public.application-form',compact('cell','name','cid','steamID','lastArrest'));
    }


}
