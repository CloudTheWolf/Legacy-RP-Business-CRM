<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discord_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discord_id')->unique(); // Discord user ID
            $table->mediumText('access_token');
            $table->mediumText('refresh_token');
            $table->timestamp('expires_at');  // To track when the access token expires
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discord_tokens');
    }
};
