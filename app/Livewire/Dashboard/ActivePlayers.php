<?php

namespace App\Livewire\Dashboard;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Livewire\Component;

class ActivePlayers extends Component
{

    public $inCityCount = "Unknown";

    public function render()
    {
        $this->getPlayerCount();
        return view('livewire.dashboard.active-players');
    }

    /**
     * @throws GuzzleException
     */
    private function getPlayerCount(): void
    {
        $client = new Client([
            'base_uri' => env("API_BASE_URI"),
            'timeout' => 5,
            'verify' => env('VERIFY_HTTPS',true),
            ]);
        $response = $client->request('GET', '/op-framework/players.json');
        $this->inCityCount = count(json_decode($response->getBody())->data);
    }
}
