<?php

namespace App\Http\Livewire\Mechanic\Forms;

use App\Models\TowLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class TowTracker extends Component
{

    public int $local,
        $citizen,
        $pd_ems,
        $help;

    public function mount()
    {
        $towTally = TowLog::query()->where('userId','=',Auth::user()->id)->first();
        $this->local = $towTally->local;
        $this->citizen = $towTally->citizen;
        $this->pd_ems = $towTally->pd;
        $this->help = $towTally->help;

    }
    public function render()
    {
        return view('mechanic.forms.tow-tracker');
    }

    public function updated()
    {
        $towTally = TowLog::query()->where('userId','=',Auth::user()->id)->first();
        $towTally->local = $this->local;
        $towTally->citizen = $this->citizen;
        $towTally->pd = $this->pd_ems;
        $towTally->help = $this->help;
        $towTally->save();
    }

    public function add_local()
    {
        $this->local++;
        $this->updated();
    }

    public function add_player()
    {
        $this->citizen++;
        $this->updated();
    }

    public function add_pd_ems()
    {
        $this->pd_ems++;
        $this->updated();
    }

    public function add_help()
    {
        $this->help++;
        $this->updated();
    }

    public function reset_tally()
    {
        $this->local = 0;
        $this->citizen = 0;
        $this->pd_ems = 0;
        $this->help = 0;
        $towTally = TowLog::query()->where('userId','=',Auth::user()->id)->first();
        $towTally->local = $this->local;
        $towTally->citizen = $this->citizen;
        $towTally->pd = $this->pd_ems;
        $towTally->help = $this->help;
        $towTally->save();

    }

    public function log_tally()
    {
        $local = $this->local;
        $citizen = $this->citizen;
        $pd = $this->pd_ems;
        $help = $this->help;

        $this->local = 0;
        $this->citizen = 0;
        $this->pd_ems = 0;
        $this->help = 0;
        $towTally = TowLog::query()->where('userId','=',Auth::user()->id)->first();
        $towTally->local = $this->local;
        $towTally->citizen = $this->citizen;
        $towTally->pd = $this->pd_ems;
        $towTally->help = $this->help;
        $towTally->save();
        if(config('app.towWebhook') === null || config('app.towWebhook') === '')
        {
            return redirect()->back()->with('log-success', 'Tally reset but can\'t be logged as Discord Webhook not configured');
        }

        Http::withoutVerifying()->post(Config('app.towWebhook'), [
            "embeds"=> [
                [
                    "title"=> Auth::user()->name." Tow Log",
                    "description"=> Auth::user()->name." Tow Log Submitted At ".now(),
                    "color"=> 11022999,
                    "author"=> [
                        "name"=> env('COMPANY_NAME')." Tow Log System"
                    ],
                    "fields" => [
                        [
                            "name" => "🚗 Local Cars",
                            "value" => $local,
                            "inline" => false
                        ],
                        [
                            "name" => "👪 Citizen Cars",
                            "value" => $citizen,
                            "inline" => true
                        ],
                        [
                            "name" => "🚓 Emergency Services",
                            "value" => $pd,
                            "inline" => false
                        ],
                        [
                            "name" => "🆘 Generic Help (Transport Vehicle, etc)",
                            "value" => $help,
                            "inline" => true
                        ]
                    ]
                ]
            ],
        ]);
        return redirect()->back()->with('log-success', 'Tally Logged to Discord');

    }



}
