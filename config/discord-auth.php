<?php

return [

    /*
     * Redirect URL after login
     */
    'redirect_uri' => '/auth/discord/handle',


    /*
     * Client ID (set in .env file) [https://discord.com/developers]
     */
    'client_id' => env('DISCORD_CLIENT_ID', ''),

    /*
     * Client Secret (set in .env file) [https://discord.com/developers]
     */
    'client_secret' => env('DISCORD_SECRET', ''),

    /*
     * Bot Token, Allows for adding users to server
     */

    'bot_token' => env('DISCORD_TOKEN'),

    /*
     * Is using https ?
     */
    'https' => env("OAUTH_HTTPS",true),
];
