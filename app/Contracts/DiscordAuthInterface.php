<?php

namespace App\Contracts;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface DiscordAuthInterface
{
    public function redirectToProvider(): RedirectResponse;

    public function handleProviderCallback(Request $request);
}
