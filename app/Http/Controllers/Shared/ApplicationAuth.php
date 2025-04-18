<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\Applications;
use Exception;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ApplicationAuth extends Controller
{
    public function Discord(): View
    {
        $application_state = Config::get('app.enableApplications','Yes');
        return view('public.application.discord-auth', compact('application_state'));
    }

    public function Steam(): View
    {
        return view('public.application.steam-auth');
    }

    public function SetCid(Request $request)
    {
        if(Session::get('discordId') == null)
        {
            return redirect('/apply');
        }

        $discordName = Session::get('discordUsername');
        $discordDiscriminator = Session::get('discordDiscriminator');
        if($discordDiscriminator != '0')
        {
            $discordName = "$discordName#$discordDiscriminator";
        }
        return view('public.application.select-character',compact('discordName'));
    }


    public function ShowForm(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|View|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if($request->input('cid') == null)
        {
            return redirect('/apply');
        }

        try {
            $apiToken = $this->GetMdtApiTokenFromCache();
            list($client, $response) = $this->GetLastArrest($request,$apiToken);
            $arrestData = json_decode($response->getBody(), true);
            bdump($response,"HTTP Response ");
            bdump($arrestData,"Body");
            bdump($client,"client");
            $lastArrest = array_key_exists('lastArrestedDate', $arrestData) ?
                Carbon::parse($arrestData['lastArrestedDate'])->format("l F dS Y") . " at " .
                Carbon::parse($arrestData['lastArrestedDate'])->format("h:i A") . " (UTC) for..." : "Never";
        }
        catch(GuzzleException $e)
        {
            Log::warning($e->getMessage());
            $lastArrest = $e->getMessage();
        }
        $user = Http::withToken(env('OP_FW_API_KEY'))->acceptJson()->withoutVerifying() ->get(env('OP_FW_REST_URI').'/characters?select=*&where=character_id='.$request->input('cid'))->json('data')[0];
        $discordName = Session::get('discordUsername');//$request->input('discordName');
        if(Session::get('discordDiscriminator ') != null)
        {
            $discordName = $discordName."#".Session::get('discordDiscriminator ');
        }
        $discordId = Session::get('discordId');//$request->input('discordId');
        $steamID = $request->input('steamId');
        $cid = $request->input('cid');
        $name = $user["first_name"] . " " . $user["last_name"];
        $cell = $user["phone_number"];
        if(config('app.siteMode') == "Bar" || config('app.siteMode') == "Arcade")
        {
            return view('Public.vg-application-form',compact('cell','name','cid','steamID','lastArrest','discordName','discordId'));
        }
        return view('mechanic.application-form',compact('cell','name','cid','steamID','lastArrest','discordName','discordId'));
    }

    public function submitMechanicApplication(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $about = "My Timezone: {$request->input('timezone')}\n\n{$request->input('about')}";

        $application = new Applications();

        $application->name = $request->input('name');
        $application->discord = $request->input('discord');
        $application->discordId = $request->input('discordId');
        $application->steam = $request->input('steam');
        $application->cid = $request->input('cid');
        $application->cell = $request->input('cell');
        $application->about = $about;
        $application->why = $request->input('why');
        $application->record = $request->input('record');
        $application->gang =  $request->input('gang') == 1;
        $application->save();
        $status = null;
        if(config('app.postJobApplications')) {
           Http::withoutVerifying()->post(config('app.jobWebhook'), [
                "username" => "Application From: " . $request->input('name'),
                "content" => "[Click Here To View On Website](<".url(env('app_url') . "/admin/applications/". $application->id).">)",
                "embeds" => [
                    [
                        "title" => "New Job Application",
                        "description" => "A new job application has been submitted",
                        "color" => hexdec(Config::get('app.discord-embed-color','EA5AFA')),
                        "fields" =>
                            [
                                [
                                    "name" => "Name",
                                    "value" => $request->input('name'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Discord",
                                    "value" => $request->input('discord'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Passport (Steam) ID",
                                    "value" => $request->input('steam'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "CID",
                                    "value" => $request->input('cid'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Cell Phone",
                                    "value" => $request->input('cell'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Tell us a little about yourself",
                                    "value" => $about,
                                    "inline" => false
                                ],
                                [
                                    "name" => "Tell us why you want a job at " . env("COMPANY_NAME") . " and why we should hire you!",
                                    "value" => $request->input('why'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Tell us about your Criminal Record",
                                    "value" => $request->input('record'),
                                    "inline" => false
                                ],
                                [
                                    "name" => "Do you have any gang ties, or affiliations that may affect your employment?",
                                    "value" => $request->input('gang') == 1 ? "Yes" : "No",
                                    "inline" => false
                                ],
                            ],
                        "author" => [
                            "name" => "🔔 New Job Application",
                        ],
                        "footer" => [
                            "text" => "Developed By CloudTheWolf 🐺",
                            "icon_url" => "https://cloudthewolf.com/images/pngtuber-closed-2.png"
                        ],
                    ]
                ]
            ]);
        }
        return redirect(url('apply-done'));
    }

    private function GetMdtApiTokenFromCache(): string
    {
        if(Storage::disk('local')->missing('tmpMdtToken'))
        {
            Storage::disk('local')->put('tmpMdtToken','');
        }
        return Storage::disk('local')->get('tmpMdtToken');
    }

    /**
     * @param Request $request
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    public function GetLastArrest(Request $request, string $apiToken): array
    {
        if(strlen($apiToken) == 0)
        {
            $apiToken = $this->GetNewApiToken();
        }
        $client = new Client(['base_uri' => Config('app.mdtUrl'), 'timeout' => 60, 'headers' => [
            'referer' => env('APP_URL') == "http://localhost:8000" ? 'https://harmony.legacyrp.company' : url('/'),
            'accept' => 'application/json',
            'origin' => env('APP_URL') == "http://localhost:8000" ? 'https://harmony.legacyrp.company' : url('/'),
            'Authorization' => 'Bearer '.trim(str_replace('\n','',str_replace('\r','',$apiToken))),
        ]]);

        $response = $client->get('/arrests/' . $request->input('cid'));
        if($response->getStatusCode() == 401 || $response->getStatusCode() == 403)
        {
            $newToken = $this->GetNewApiToken();
            $client = new Client(['base_uri' => Config('app.mdtUrl'), 'timeout' => 60, 'headers' => [
                'accept' => 'application/json',
                'Authorization' => 'Bearer '.trim(str_replace('\n','',str_replace('\r','',$newToken)))
            ]]);
            $response = $client->get('/arrests/' . $request->input('cid'));
        }
        return array($client, $response);
    }

    /**
     * @throws Exception
     */
    private function GetNewApiToken(): string
    {
        $apiKey = env('MDT_API_KEY');
        $client = new Client(['base_uri' => Config('app.mdtUrl'), 'timeout' => 60,'headers' =>[
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept' => 'application/json'
        ]]);

        $response = $client->request('POST', 'api/auth');
        if($response->getStatusCode() == 200)
        {
            $token = json_decode($response->getBody()->getContents())->token->accessToken;
            Storage::disk('local')->put('tmpMdtToken', $token);
            return $token;
        }
        throw new exception('Failed to get new token');
    }
}
