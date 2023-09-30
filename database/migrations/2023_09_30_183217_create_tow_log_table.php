<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTowLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tow_log')) {
            Schema::create('tow_log', function (Blueprint $table) {
                $table->integer('userId')->unique('userId');
                $table->integer('local')->default(0);
                $table->integer('citizen')->default(0);
                $table->integer('pd')->default(0);
                $table->integer('help')->default(0);
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
        Schema::dropIfExists('tow_log');
    }
}
