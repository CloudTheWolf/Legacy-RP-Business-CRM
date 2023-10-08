<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(Schema::hasTable('repair_log')) {
            Schema::table('repair_log', function (Blueprint $table) {
                $table->integer('cid')->nullable()->after('mechanic');
            });

            DB::statement("UPDATE repair_log rl JOIN users u ON rl.Mechanic = u.id SET rl.cid = u.CID ");
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('repair_log','cid')) {
            Schema::table('repair_log', function (Blueprint $table) {
                $table->dropColumn('cid');
            });
        };
    }
};
