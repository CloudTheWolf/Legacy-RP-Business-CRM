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
        if(Schema::hasTable('applications')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->unsignedBigInteger('discordId')->after('discord')->nullable()->default(null);
            });
        }

        if(Schema::hasTable('vgApplications')) {
            Schema::table('vgApplications', function (Blueprint $table) {
                $table->unsignedBigInteger('discordId')->after('discord')->nullable()->default(null);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('applications','discordId')) {
            Schema::table('applications', function (Blueprint $table) {
                $table->dropColumn('discordId');
            });
        }

        if(Schema::hasColumn('vgApplications','discordId')) {
            Schema::table('vgApplications', function (Blueprint $table) {
                $table->dropColumn('discordId');
            });
        }
    }

};
