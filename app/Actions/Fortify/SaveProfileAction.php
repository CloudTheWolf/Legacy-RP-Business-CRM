<?php

namespace App\Actions\Fortify;

use App\Contracts\SaveProfile as Contract;
use App\Models\user;
use Illuminate\Support\Facades\Validator;


class SaveProfileAction implements Contract
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(user $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'cell' => ['required', 'string', 'max:8'],
            'towID' => ['nullable', 'string', 'max:255'],
        ])->validateWithBag('updateProfile');

        $user->forceFill([
            'name' => $input['name'],
            'cell' => $input['cell'],
            'towID' => $input['towID'],
        ])->save();

    }
}
