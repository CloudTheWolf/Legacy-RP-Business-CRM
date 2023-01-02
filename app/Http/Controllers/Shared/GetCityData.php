<?php

namespace App\Http\Controllers\Shared;

use GuzzleHttp\Client;

class GetCityData
{
    public static function GetInCityCount() : string
    {
        try {
            $client = new Client(['base_uri' => env("API_BASE_URI"),'timeout' => 5]);
            $response = $client->request('GET', '/op-framework/users.json');
            return count(json_decode($response->getBody())->data);
        }
        catch(\Exception $e)
        {
            return 'API Error';
        }
    }
}
