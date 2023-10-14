<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('repair_log')) {
            Schema::create('repair_log', function (Blueprint $table) {
                $table->integer('id')->primary();
                $table->integer('mechanic');
                $table->string('customer_name')->nullable();
                $table->string('vehicle', 500)->nullable();
                $table->integer('scrap_used')->default(0);
                $table->integer('alum_used')->default(0);
                $table->integer('steel_used')->default(0);
                $table->integer('glass_used')->default(0);
                $table->integer('rubber_used')->default(0);
                $table->integer('cost');
                $table->timestamp('timestamp')->default('current_timestamp()');
                $table->boolean('deleted')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_log');
    }
};
