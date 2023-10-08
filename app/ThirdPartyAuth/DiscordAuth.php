<?php

namespace App\ThirdPartyAuth;

use App\Contracts\DiscordAuthInterface;
use App\Models\DiscordToken;
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

        $this->guzzleClient = new GuzzleClient(['verify' => env('VERIFY_HTTPS',true)]);
    }

    public function redirectToProvider(): RedirectResponse
    {
        return redirect($this->getAuthUrl());
    }

    public function redirectApplyToProvider(): RedirectResponse
    {
        $this->authUrl = $this->buildUrl(
            url('/apply/auth/discord/handle',[],Config::get('discord-auth.https'))
        );

        return redirect($this->getAuthUrl());
    }

    public function redirectExistingToProvider(): RedirectResponse
    {
        $this->authUrl = $this->buildUrl(
            url('/auth/discord/handle/link',[],Config::get('discord-auth.https'))
        );

        return redirect($this->authUrl);
    }
    public function handleProviderCallback(Request $request, $callback = null)
    {
        $code = $request->get('code');
        if(!$code) return; //TODO: Add Error Handling

        if(!is_null($callback)) {
            $this->REDIRECT_URI = $callback;
        }

        try {
            $tokens = $this->getAccessTokens($code);
            $access = $tokens['access_token'];
            $refresh = $tokens['refresh_token'];
            $expires = $tokens['expires_in'];
            $userData = $this->getUserInfo($access);
            $this->updateToken($userData['id'],$access,$refresh,$expires);
        } catch (\Exception $e)
        {
            return redirect(route('auth.discord'));
        }

        return new DiscordInfo($userData);
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
     * @param string|null $url A custom return to URL
     *
     * @return string
     */
    private function buildUrl($url = null): string
    {
        if (is_null($url)) {
            $url = url('/', [], Config::get('discord-auth.https'));
        }

        if (! is_null($url) && ! $this->validateUrl($url)) {
            throw new RuntimeException('The return URL must be a valid URL with a URI scheme or http or https.');
        }

        $params = [
            "client_id" => $this->DISCORD_CLIENT_ID,
            "redirect_uri" => url($url),
            "response_type" => "code",
            "scope" => "identify guilds.join"
        ];

        return self::DISCORD_AUTH_URL.'?'.http_build_query($params, '', '&');
    }

    private function getAccessTokens($code)
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
        return $body;
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

    private function updateToken($id,$access,$refresh,$expires)
    {

        try {
            $tokenData = DiscordToken::query()->whereDiscordId($id)->firstOrNew();
            $tokenData->discord_id = $id;
            $tokenData->access_token = $access;
            $tokenData->refresh_token = $refresh;
            $tokenData->expires_at = now()->addSeconds($expires);
            $tokenData->save();
        }
        catch (\Exception $e)
        {

        }
    }

}
