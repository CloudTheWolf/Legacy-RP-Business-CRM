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
        if(!Schema::hasColumn('barSales','cid'))
        {
            Schema::table('barSales', function (Blueprint $table) {
                $table->integer('cid')->after('staff')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('barSales','cid'))
        {
            Schema::create('barSales', function (Blueprint $table){
                $table->dropColumn('cid');
            });
        }
    }
};
