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
        if(!Schema::hasTable('workTime')) {
            Schema::create('workTime', function (Blueprint $table) {
                $table->id();
                $table->timestamp('clockInAt')->useCurrent();
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
};
