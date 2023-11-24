<?php

namespace App\Http\Livewire\Mechanic\Forms;

use App\Components\SettingsSaver;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

class MechanicSettings extends Component
{

    public int $scrap_buy,
        $scrap_sell,
        $aluminium_buy,
        $aluminium_sell,
        $steel_buy,
        $steel_sell,
        $glass_buy,
        $glass_sell,
        $rubber_buy,
        $rubber_sell,
        $advanced_kit_sell,
        $oil_sell;


    public function mount()
    {
        $this->scrap_buy = Config::get('app.scrap-buy',50);
        $this->scrap_sell = Config::get('app.scrap-sell',75);

        $this->aluminium_buy = Config::get('app.aluminium-buy',70);
        $this->aluminium_sell = Config::get('app.aluminium-sell',100);

        $this->steel_buy = Config::get('app.steel-buy',90);
        $this->steel_sell = Config::get('app.steel-sell',120);

        $this->glass_buy = Config::get('app.glass-buy',25);
        $this->glass_sell = Config::get('app.glass-sell',40);

        $this->rubber_buy = Config::get('app.rubber-buy',10);
        $this->rubber_sell = Config::get('app.rubber-sell',15);

        $this->advanced_kit_sell = Config::get('app.adv-repair-kit-sell',500);
        $this->oil_sell = Config::get('app.oil-sell',500);
    }

    public function render()
    {
        return view('mechanic.forms.mechanic-settings');
    }

    public function save_settings()
    {
        $settings = new SettingsSaver();

        $settings->SaveSetting('scrap-buy',$this->scrap_buy,'mechanic');
        $settings->SaveSetting('scrap-sell',$this->scrap_sell,'mechanic');

        $settings->SaveSetting('aluminium-buy',$this->aluminium_buy,'mechanic');
        $settings->SaveSetting('aluminium-sell',$this->aluminium_sell,'mechanic');

        $settings->SaveSetting('steel-buy',$this->steel_buy,'mechanic');
        $settings->SaveSetting('steel-sell',$this->steel_sell,'mechanic');

        $settings->SaveSetting('glass-buy',$this->glass_buy,'mechanic');
        $settings->SaveSetting('glass-sell',$this->glass_sell,'mechanic');

        $settings->SaveSetting('rubber-buy',$this->rubber_buy,'mechanic');
        $settings->SaveSetting('rubber-sell',$this->rubber_sell,'mechanic');

        $settings->SaveSetting('adv-repair-kit-sell',$this->advanced_kit_sell,'mechanic');

        $settings->SaveSetting('oil-sell',$this->oil_sell,'mechanic');
        $this->dispatch('saved');
    }
}
