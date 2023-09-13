<?php

namespace App\Http\Controllers\Shared\Team;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;


class TeamController extends Controller
{

    public function Get()
    {
        $users = User::whereDisabled(0)->get();
        $onlineUsers = $this->getOnlineUsers();

        return view('Shared.Team.view-team',compact('users','onlineUsers'));
    }

    private function getOnlineUsers()
    {
        $client = new Client(['base_uri' => env("API_BASE_URI")]);
        try {
            $response = $client->request('GET', '/op-framework/players.json');
        } catch (GuzzleException $e) {
            $error = array();
            $error['data'] = array();
            return $error;
        }



        return json_decode($response->getBody(),true);
    }
}
