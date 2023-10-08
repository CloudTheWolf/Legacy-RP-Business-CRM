<?php

namespace App\ThirdPartyAuth;

use Illuminate\Support\Fluent;

class DiscordInfo extends Fluent
{
    /**
     * {@inheritdoc}
     */
    public function __construct($data)
    {
        $discordID = $data['id'] ?? null;
        unset($data['id']);

        parent::__construct($data);

        $this->attributes['id'] = $discordID;
    }
}
