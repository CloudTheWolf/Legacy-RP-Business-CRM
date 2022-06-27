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
        $onlineUsers = self::getOnlineUsers();
        return view("team-list")->with('users',$users)->with('onlineUsers',$onlineUsers);
    }

    static function getOnlineUsers()
    {
        $client = new Client(['base_uri' => env("API_BASE_URI")]);
        try {
            $response = $client->request('GET', '/op-framework/users.json');
        } catch (GuzzleException $e) {
            return 500;
        }
        $userState = json_decode($response->getBody(),true);
        return $userState; //$userState->statusCode;
    }
}
