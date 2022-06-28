<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('repair_log', function (Blueprint $table) {
            $table->id();
            $table->integer('mechanic');
            $table->string('customer_name')->nullable(true);
            $table->string('vehicle')->nullable(true);
            $table->integer('scrap_used')->default('0');
            $table->integer('alum_used')->default('0');
            $table->integer('steel_used')->default('0');;
            $table->integer('glass_used')->default('0');;
            $table->integer('rubber_used')->default('0');
            $table->integer('cost');
            $table->timestamp('timestamp');
            $table->tinyInteger('deleted');

        });
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
