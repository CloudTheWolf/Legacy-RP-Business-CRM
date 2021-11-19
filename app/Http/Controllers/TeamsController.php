<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class TeamsController extends BaseController
{

    function viewTeam()
    {
        $users = DB::table('users')->where("disabled","=","0")->orderBy("id")->get();
        return view("team-list")->with('users',$users);
    }

    static function checkState($cid)
    {
        $client = new Client(['base_uri' => env("API_BASE_URI")]);
        try {
            $response = $client->request('GET', '/op-framework/character.json?characterId=' . $cid);
        } catch (GuzzleException $e) {
            return 500;
        }
        $userState = json_decode($response->getBody());
        return $userState->statusCode;
    }
}
