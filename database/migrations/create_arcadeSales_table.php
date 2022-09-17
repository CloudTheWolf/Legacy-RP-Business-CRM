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
        Schema::create('arcadeSales', function (Blueprint $table) {
            $table->integer('id', true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('staff');
            $table->integer('pizza');
            $table->integer('hotdog');
            $table->integer('nacho');
            $table->integer('waffle');
            $table->integer('water');
            $table->integer('coke');
            $table->integer('milk');
            $table->integer('beer');
            $table->integer('cider');
            $table->integer('tequila');
            $table->integer('wine');
            $table->integer('vodka');
            $table->integer('absinthe');
            $table->integer('rum');
            $table->integer('whiskey');
            $table->integer('zombie');
            $table->integer('arena');
            $table->integer('arenaPizza');
            $table->integer('lunchSpecial');
            $table->integer('fullPie');
            $table->integer('mexicanWave');
            $table->integer('happyHour');
            $table->integer('finalCost');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arcadeSales');
    }
};
