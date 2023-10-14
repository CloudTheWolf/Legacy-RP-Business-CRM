<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\ThirdPartyAuth\SteamAuth;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class SteamLogin extends Controller
{

    protected $steam;

    protected $redirectURL = "/";

    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    function get(Request $request)
    {
        if (($request->getPathInfo()) == "/apply/auth/steam")
        {
            $this->steam->setRedirectUrl(route('apply.auth.steam.handle'));
        }

        return $this->steam->redirect();
    }

    /**
     * @throws GuzzleException
     */
    function handle(Request $request)
    {
        if (!$this->steam->validate()) {
            return redirect((route("auth.steam")));
        }

        if (($request->getPathInfo()) == "/apply/auth/steam/handle") {;
            return redirect(url('/apply/select-profile'))->with('steamID', 'steam:' . dechex((int)$this->steam->getUserInfo()->steamID64));
        }

        $info = $this->steam->getUserInfo();

        if (!is_null($info)) {
            $user = $this->findUser($info);
            if ($user->disabled == 1) {
                return back()->with(
                    'error', 'Account Disabled.',
                );
            }

            Auth::login($user, true);
            return redirect($this->redirectURL);
        } else {
            return back()->with(
                'error', 'No user found matching Steam ID.',
            );
        }
    }

    protected function findUser($info)
    {
        $user = User::whereSteamId('steam:' . dechex((int)$info->steamID64))->whereDisabled(0)->first();

        if (!is_null($user)) {
            return $user;
        }

        return null;
    }

}
