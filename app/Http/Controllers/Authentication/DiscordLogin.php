<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\ThirdPartyAuth\DiscordAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscordLogin extends Controller
{
    protected $discord;

    protected $redirectURL = '/';

    public function __construct(DiscordAuth $discord)
    {
        $this->discord = $discord;
    }

    function get(Request $request)
    {
        return $this->discord->redirectToProvider();
    }

    public function handle(Request $request)
    {
        try {
            $code = $request->get('code');

            if (!$code) {
                // Handle missing code query parameter.
                return redirect('/login')->with('error', 'Missing authorization code.');
            }

            $discordInfo = $this->discord->handleProviderCallback($request);
            if (!$discordInfo || !$discordInfo->id) {
                // Handle error in Discord authentication.
                return redirect('/login')->with('error', 'Error Getting Discord ID, Try Again or try anthor method.');
            }

            $user = User::whereDiscord($discordInfo->id)->whereDisabled(0)->first();
            if(is_null($user))
            {
                return redirect('/login')->with('error', "No active user found linked to this discord");
            }

            Auth::login($user, true);

            return redirect('/dashboard')->with('success', 'Successfully authenticated with Discord.');

        } catch (\Exception $e) {
            // Log the exception or handle it differently if needed.
            return redirect('/login')->with('error', 'An error occurred while trying to authenticate with Discord.');
        }
    }


}
