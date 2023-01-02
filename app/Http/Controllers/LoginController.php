<?php

namespace App\Http\Controllers;
use Invisnik\LaravelSteamAuth\SteamAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $remember = isset($request->rememberMe);
        $credentials = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        );

        if (Auth::attempt($credentials,$remember)) {
            $request->session()->regenerate();
            if (Auth::user()->disabled == 1)
                {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return back()->with("error","Account Disabled");
                }
            return redirect()->intended('/index');
        } else {
            return back()->with(
                'error', 'The provided credentials do not match our records.',
            );
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * The SteamAuth instance.
     *
     * @var SteamAuth
     */
    protected $steam;

    /**
     * The redirect URL.
     *
     * @var string
     */
    protected $redirectURL = '/';

    /**
     * AuthController constructor.
     *
     * @param SteamAuth $steam
     */
    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    /**
     * Redirect the user to the authentication page
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToSteam()
    {
        return $this->steam->redirect();
    }

    public function jobApplicationSendToSteam(Request $request)
    {

        $this->steam->setRedirectUrl(route('apply.auth.steam.handle'));
        return $this->steam->redirect();
    }


    /**
     * Get user info and log in
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle()
    {
        if (!$this->steam->validate()) {
            return $this->redirectToSteam();
        }
        $info = $this->steam->getUserInfo();

        if (!is_null($info)) {
            $user = $this->findOrNewUser($info);
            if ($user->disabled == 1) {
                return back()->with(
                    'error', 'Account Disabled.',
                );
            }

            Auth::login($user, true);

            return redirect($this->redirectURL); // redirect to site
        } else {
            return back()->with(
                'error', 'No user found matching Steam ID.',
            );
        }
    }

    public function handleApplication()
    {
        if(!$this->steam->validate())
        {
            return $this->redirectToSteam();
        }

        return redirect(url('/apply/select-profile'))->with('steamID','steam:'.dechex((int)$this->steam->getUserInfo()->steamID64));


    }

    /**
     * Getting user by info or created if not exists
     *
     * @param $info
     * @return User
     */
    protected function findOrNewUser($info)
    {
        $user = User::where('steamId', 'steam:'.dechex((int)$info->steamID64))->first();
        if (!is_null($user)) {
            return $user;
        }

        return null;
        // For now we don't need to create user
        /*
        return User::create([
            'username' => $info->personaname,
            'avatar' => $info->avatarfull,
            'steamid' => $info->steamID64
        ]);*/
    }

}
