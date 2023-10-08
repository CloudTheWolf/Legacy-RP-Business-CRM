<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('workTime')) {
            Schema::create('workTime', function (Blueprint $table) {
                $table->integer('id')->primary();
                $table->timestamp('clockInAt')->default('current_timestamp()');
                $table->timestamp('clockOutAt')->nullable();
                $table->integer('cid');
                $table->integer('totalTime')->default(0);
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
        Schema::dropIfExists('workTime');
    }
}
