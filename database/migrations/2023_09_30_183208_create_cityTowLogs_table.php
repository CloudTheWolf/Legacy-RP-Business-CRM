<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityTowLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('cityTowLogs')) {
            Schema::create('cityTowLogs', function (Blueprint $table) {
                $table->integer('rowId')->primary();
                $table->integer('id');
                $table->integer('characterId');
                $table->timestamp('timestamp')->default('0000-00-00 00:00:00');
                $table->string('modelName');
                $table->integer('reward');
                $table->tinyInteger('playerVehicle');
                $table->string('plateNumber', 11);
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
        Schema::dropIfExists('cityTowLogs');
    }
}
