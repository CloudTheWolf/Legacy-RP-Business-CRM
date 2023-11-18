<?php

namespace App\Http\Livewire\Mechanic\Forms;

use App\Models\Applications;
use App\Models\DiscordRole;
use App\Models\DiscordToken;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class JobApplicationReview extends Component
{
    public int $id,$cid;
    public string $name,$email,$cell,$role,$discord,$discordId, $steam = "0";

    public string $about, $why, $record;

    public bool $gang;

    private Applications $application;

    public function mount($id)
    {
        $this->application = Applications::query()->whereId($id)->first();
        if($this->application->discordId == null)
        {
            $this->application->discordId = '';
        }
        $this->id = $id;
        $this->cid = $this->application->cid;
        $this->name = $this->application->name;
        $this->cell = $this->application->cell;
        $this->email = str_replace(' ','.',$this->application->name);
        $this->steam = $this->application->steam;
        $this->discord = $this->application->discord;
        $this->discordId = $this->application->discordId;

        $this->about = $this->application->about;
        $this->why = $this->application->why;
        $this->record = $this->application->record;
        $this->gang = boolval($this->application->gang);
    }
    public function render()
    {
        return view('mechanic.forms.job-application-review');
    }

    public function reject(): void
    {
        $application = Applications::query()->whereId($this->id)->first();
        $application->state = 1;
        $application->save();
        $this->dispatch('rejected',['message'=>'Application Rejected']);
    }
}
