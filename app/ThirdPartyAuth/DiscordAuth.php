<?php

namespace App\ThirdPartyAuth;

use App\Contracts\DiscordAuthInterface;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Config;
use RuntimeException;

class DiscordAuth implements DiscordAuthInterface
{
    const DISCORD_AUTH_URL = "https://discord.com/api/oauth2/authorize";
    public string $authUrl;
    private mixed $DISCORD_CLIENT_ID;
    private mixed $DISCORD_CLIENT_SECRET;
    private mixed $REDIRECT_URI;
    private Request $request;
    protected GuzzleClient $guzzleClient;


    public function __construct(Request $request)
    {

        $this->request = $request;

        $this->DISCORD_CLIENT_ID = Config::get('discord-auth.client_id');
        $this->DISCORD_CLIENT_SECRET = Config::get('discord-auth.client_secret');
        $this->REDIRECT_URI = Config::get('discord-auth.redirect_uri');

        $this->authUrl = $this->buildUrl(
            url($this->REDIRECT_URI,[],Config::get('discord-auth.https'))
        );
        $this->guzzleClient = new GuzzleClient(['verify' => env('OAUTH_VERIFY_HTTPS',true)]);
    }

    public function redirectToProvider(): RedirectResponse
    {
        return redirect($this->getAuthUrl());
    }

    public function handleProviderCallback(Request $request)
    {
        $code = $request->get('code');

        if(!$code) return; //TODO: Add Error Handling
        try {
            $token = $this->getAccessToken($code);
            $userData = $this->getUserInfo($token);
        } catch (\Exception $e)
        {

                return redirect(route('auth.discord'));


        }
        return new DiscordInfo($userData);
    }

    /**
     * Set the url to return to.
     *
     * @param string $url Full URL to redirect to on Steam login
     *
     * @return void
     */
    public function setRedirectUrl(string $url): void
    {
        $this->authUrl = $this->buildUrl($url);
    }

    /**
     * Returns the login url.
     *
     * @return string|null
     */
    public function getAuthUrl(): ?string
    {

        return $this->authUrl;
    }

    /**
     * Build the Steam login URL.
     *
     * @param string|null $return A custom return to URL
     *
     * @return string
     */
    private function buildUrl($return = null): string
    {
        if (is_null($return)) {
            $return = url('/', [], Config::get('discord-auth.https'));
        }
        if (! is_null($return) && ! $this->validateUrl($return)) {
            throw new RuntimeException('The return URL must be a valid URL with a URI scheme or http or https.');
        }

        $params = [
            "client_id" => $this->DISCORD_CLIENT_ID,
            "redirect_uri" => url($this->REDIRECT_URI),
            "response_type" => "code",
            "scope" => "identify email"
        ];
        return self::DISCORD_AUTH_URL.'?'.http_build_query($params, '', '&');
    }

    private function getAccessToken($code)
    {
        $response = $this->guzzleClient->post('https://discord.com/api/oauth2/token', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'client_id' => $this->DISCORD_CLIENT_ID,
                'client_secret' => $this->DISCORD_CLIENT_SECRET,
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => url($this->REDIRECT_URI),
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);

        if (isset($body['error'])) {
            if(str_contains($body['error_description'],"Invalid \\\"code\\\" in request."))
            {
                redirect(url('/auth/discord'));
            }
            throw new \Exception("Discord OAuth error: {$body['error_description']}");
        }
        return $body['access_token'];
    }

    private function getUserInfo($token)
    {
        $response = $this->guzzleClient->get('https://discord.com/api/users/@me', [
            'headers' => [
                'Authorization' => "Bearer {$token}"
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Validates a given URL, ensuring it contains the http or https URI Scheme.
     *
     * @param $url
     *
     * @return bool
     */
    private function validateUrl($url): bool
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        return true;
    }
}
