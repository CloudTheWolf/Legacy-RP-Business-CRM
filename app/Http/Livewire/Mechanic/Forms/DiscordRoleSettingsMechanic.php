<?php

namespace App\Http\Livewire\Mechanic\Forms;

use App\Components\SettingsSaver;
use App\Models\DiscordRole;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Livewire\Component;

class DiscordRoleSettingsMechanic extends Component
{
    public string $role_staff,
        $role_tow,
        $role_intern,
        $role_mechanic,
        $role_lead,
        $role_expert,
        $role_veteran,
        $role_trainer,
        $role_manager,
        $role_vet_manager;

    public function mount() : void
    {
        $roles = DiscordRole::query()->get();
        $this->role_staff = $roles->where('role_name','Staff')->first()?->role_id ?? '';
        $this->role_tow = $roles->where('role_name','Tow Driver')->first()?->role_id ?? '';
        $this->role_intern = $roles->where('role_name','Intern Mechanic')->first()?->role_id ?? '';
        $this->role_mechanic = $roles->where('role_name','Mechanic')->first()?->role_id ?? '';
        $this->role_lead = $roles->where('role_name','Lead Mechanic')->first()?->role_id ?? '';
        $this->role_expert = $roles->where('role_name','Expert Mechanic')->first()?->role_id ?? '';
        $this->role_veteran = $roles->where('role_name','Veteran Mechanic')->first()?->role_id ?? '';
        $this->role_trainer = $roles->where('role_name','Trainer')->first()?->role_id ?? '';
        $this->role_manager = $roles->where('role_name','Manager')->first()?->role_id ?? '';
        $this->role_vet_manager = $roles->where('role_name','Veteran Manager')->first()?->role_id ?? '';

    }

    public function render() : View
    {
        return view('mechanic.forms.discord-role-settings-mechanic');
    }

    public function save_settings() : Void
    {
        $save = new SettingsSaver();
        $save->SaveDiscordRole('Staff',$this->role_staff);
        $save->SaveDiscordRole('Tow Driver',$this->role_tow);
        $save->SaveDiscordRole('Intern Mechanic',$this->role_intern);
        $save->SaveDiscordRole('Mechanic',$this->role_mechanic);
        $save->SaveDiscordRole('Lead Mechanic',$this->role_lead);
        $save->SaveDiscordRole('Expert Mechanic',$this->role_expert);
        $save->SaveDiscordRole('Veteran Mechanic',$this->role_veteran);
        $save->SaveDiscordRole('Trainer',$this->role_trainer);
        $save->SaveDiscordRole('Manager',$this->role_manager);
        $save->SaveDiscordRole('Veteran Manager',$this->role_vet_manager);
        $this->dispatch('saved');

        $this->mount();

    }
}
