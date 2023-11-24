<?php

namespace App\Http\Livewire\Shared\Forms;

use App\Components\SettingsSaver;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Livewire\Component;

class DiscordSettings extends Component
{
    public string $discord_webhook_color,
        $discord_webhook_sale,
        $discord_webhook_tow,
        $discord_webhook_job,
        $discord_webhook_timesheet,
        $discord_guild_id,
        $discord_bot_name,
        $discord_post_sale,
        $discord_post_job,
        $discord_auto_invite;

    public function mount(){
        $this->discord_webhook_color = Config::get('app.discord-embed-color','#EA5AFA');

        $this->discord_webhook_sale = Config::get('app.saleWebhook','');
        $this->discord_webhook_tow = Config::get('app.towWebhook','');
        $this->discord_webhook_job = Config::get('app.jobWebhook','');
        $this->discord_webhook_timesheet = Config::get('app.timesheetWebhook','');
        $this->discord_guild_id = Config::get('app.guild','');

        $this->discord_bot_name = Config::get('app.botName','');
        $this->discord_post_sale  = Config::get('app.postSales','No');
        $this->discord_post_job  = Config::get('app.postJobApplications','No');
        $this->discord_auto_invite  = Config::get('app.discord-auto-invite','No');

    }

    public function render() : View
    {
        return view('shared.forms.discord-settings');
    }

    public function save_settings() : Void
    {
        $settings = new SettingsSaver();
        $settings->SaveSetting('timesheetWebhook',$this->discord_webhook_timesheet,'discord');
        $settings->SaveSetting('towWebhook',$this->discord_webhook_tow,'discord');
        $settings->SaveSetting('saleWebhook',$this->discord_webhook_sale,'discord');
        $settings->SaveSetting('jobWebhook',$this->discord_webhook_job,'discord');
        $settings->SaveSetting('guild',$this->discord_guild_id,'discord');
        $settings->SaveSetting('botName',$this->discord_bot_name,'discord');
        $settings->SaveSetting('postSales',$this->discord_post_sale == 1 ? 'true' : 'false','discord');
        $settings->SaveSetting('postJobApplications',$this->discord_post_job == 1 ? 'true' : 'false','discord');
        $settings->SaveSetting('discord-embed-color',$this->discord_webhook_color,'discord');
        $settings->SaveSetting('discord-auto-invite',$this->discord_auto_invite,'discord');
        $this->dispatch('saved');

    }
}
