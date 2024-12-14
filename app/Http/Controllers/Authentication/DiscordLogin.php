<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\SessionToggleController;
use App\Models\DiscordToken;
use App\Models\User;
use App\ThirdPartyAuth\DiscordAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class DiscordLogin extends Controller
{
    protected $discord;

    public function __construct(DiscordAuth $discord)
    {
        $this->discord = $discord;
    }

    function get(Request $request)
    {
        return $this->discord->RedirectToProvider();
    }

    public function getFromProfile(Request $request)
    {
        return $this->discord->RedirectExistingToProvider();
    }

    public function getFromApply(Request $request)
    {
        return $this->discord->RedirectApplyToProvider();
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

            $user->save();
            Auth::login($user, true);

            //session(['avatar' => 'https://cdn.discordapp.com/avatars/'.$discordInfo->id.'/'.$discordInfo->avatar.'.png']);
            return redirect('/dashboard')->with('success', 'Successfully authenticated with Discord.');

        } catch (\Exception $e) {
            // Log the exception or handle it differently if needed.
            return redirect('/login')->with('error', 'An error occurred while trying to authenticate with Discord.');
        }
    }

    public function handleLink(Request $request)
    {
        try {
            $code = $request->get('code');

            if (!$code) {
                return redirect('/user/profile')->with('error', 'Missing authorization code.');
            }

            $discordInfo = $this->discord->handleProviderCallback($request,"/auth/discord/handle/link");

            if (!$discordInfo || !$discordInfo->id) {
                return redirect('/user/profile')->with('error', 'Error Getting Discord ID');
            }


            $user = User::whereId(Auth::user()->id)->first();
            $user->discord = $discordInfo->id;
            $user->avatar_url = 'https://cdn.discordapp.com/avatars/'.$discordInfo->id.'/'.$discordInfo->avatar.'.png';
            $user->saveOrFail();
            return redirect('/user/profile');

        } catch (\Exception $e) {
            // Log the exception or handle it differently if needed.
            return redirect('/user/profile')->with('error', 'An error occurred while trying to authenticate with Discord.');
        }
    }

    public function handleApply(Request $request)
    {
        try {
            $code = $request->get('code');

            if (!$code) {
                // Handle missing code query parameter.
                return redirect('/apply')->with('error', 'Missing authorization code.');
            }
            $discordInfo = $this->discord->handleProviderCallback($request,'/apply/auth/discord/handle');

            if (!$discordInfo || !$discordInfo->id) {
                // Handle error in Discord authentication.
                return redirect('/apply')->with('error', 'Error Getting Discord ID, Try Again or try another method.');
            }

            session(['discordId' => $discordInfo->id]);
            session(['discordUsername' => $discordInfo->username]);
            session(['discordDiscriminator' => $discordInfo->discriminator]);

            return redirect('/apply/steam')->with('success', 'Successfully authenticated with Discord.');

        } catch (\Exception $e) {
            // Log the exception or handle it differently if needed.
            return redirect('/apply')->with('error', 'An error occurred while trying to authenticate with Discord.');
        }
    }


}
