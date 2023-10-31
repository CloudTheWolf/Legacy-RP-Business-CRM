<?php

namespace App\Http\Livewire\Shared\Dashboard\Stats;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Livewire\Component;

class InCity extends Component
{
    public string $inCity;
    public function render()
    {
        $this->getPlayerCount();
        return view('shared.dashboard.stats.in-city');
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
        $this->inCity = count(json_decode($response->getBody())->data);
    }
}
