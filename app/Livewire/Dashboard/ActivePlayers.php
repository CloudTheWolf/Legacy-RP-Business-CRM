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

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <svg width="32" height="32" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <style>
                .spinner_0XTQ{
                        fill: var(--primary);
                        transform-origin:center;
                        animation:spinner_y6GP .75s linear infinite
                        }
                @keyframes spinner_y6GP{100%{transform:rotate(360deg)}}
                </style><path class="spinner_0XTQ" d="M12,23a9.63,9.63,0,0,1-8-9.5,9.51,9.51,0,0,1,6.79-9.1A1.66,1.66,0,0,0,12,2.81h0a1.67,1.67,0,0,0-1.94-1.64A11,11,0,0,0,12,23Z"/></svg>
        </div>
        HTML;
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
