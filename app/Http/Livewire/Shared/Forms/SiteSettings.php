<?php

namespace App\Http\Livewire\Shared\Forms;

use App\Components\SettingsSaver;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

class SiteSettings extends Component
{

    public string $app_name, $company_name, $branding_dir, $site_mode;


    public function mount()
    {
        $this->app_name = Config::get('app.APP_NAME', env('APP_NAME','My Company Site'));
        $this->company_name = Config::get('app.companyName','My Company');
        $this->branding_dir = Config::get('app.brandingPath','harmony');
        $this->site_mode = Config::get('app.siteMode','Mechanic');
    }
    public function render()
    {
        return view('shared.forms.site-settings');
    }

    public function save_settings() : Void
    {
        $settings = new SettingsSaver();
        if(strlen($this->app_name) > 0) {
            $settings->SaveSetting('APP_NAME', $this->app_name, 'site');
        }
        if(strlen($this->company_name) > 0) {
            $settings->SaveSetting('companyName', $this->company_name, 'discord');
        }
        if(strlen($this->branding_dir) > 0) {
            $settings->SaveSetting('brandingPath', $this->branding_dir, 'discord');
        }
        if(strlen($this->site_mode) > 0) {
            $settings->SaveSetting('siteMode', $this->site_mode, 'discord');
        }
        $this->dispatch('saved');

    }
}
