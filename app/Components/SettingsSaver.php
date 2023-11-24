<?php

namespace App\Components;

use App\Models\Configuration;
use App\Models\DiscordRole;

class SettingsSaver
{
    public function SaveSetting($settingName, $settingValue, $settingGroup) : void
    {
        $config = Configuration::query()->whereName($settingName)->firstOrNew();
        $config->name = $settingName;
        $config->value = $settingValue;
        $config->group = $settingGroup;
        $config->save();
    }

    public function SaveDiscordRole($role_name, $role_id) : void
    {
        $role = DiscordRole::query()->where('role_name','=',$role_name)->firstOrNew();
        $role->role_id = $role_id == '' ? '-1' : $role_id;
        $role->role_name = $role_name;
        $role->save();
    }
}
