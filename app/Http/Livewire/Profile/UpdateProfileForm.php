<?php

namespace App\Http\Livewire\Profile;

use App\Actions\Fortify\UpdateUserProfile;
use App\Contracts\SaveProfile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateProfileForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'name' => '',
        'cell' => '',
        'towID' => '',
        'steamId' => '',
        'discord' => ''
    ];

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Update the user's profile.
     *
     * @param SaveProfile $updater
     * @return void
     */
    public function updateProfile(SaveProfile $updater)
    {
        $this->resetErrorBag();
        $updater->update(Auth::user(), $this->state);
        $this->dispatch('saved');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->state = [
            'name' => Auth::user()->name,
            'cell' => Auth::user()->cell,
            'towID' => Auth::user()->towID,
            'steamId' => Auth::user()->steamId,
            'discord' => Auth::user()->discord
        ];
        return view('profile.update-profile-form');
    }
}
