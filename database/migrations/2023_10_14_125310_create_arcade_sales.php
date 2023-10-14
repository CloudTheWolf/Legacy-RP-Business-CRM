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
        if(!Schema::hasTable('arcadeSales')) {
            Schema::create('arcadeSales', function (Blueprint $table) {
                $table->id();
                $table->integer('staff');
                $table->integer('pizza')->default(0);
                $table->integer('hotdog')->default(0);
                $table->integer('nacho')->default(0);
                $table->integer('waffle')->default(0);
                $table->integer('water')->default(0);
                $table->integer('coke')->default(0);
                $table->integer('milk')->default(0);
                $table->integer('beer')->default(0);
                $table->integer('cider')->default(0);
                $table->integer('tequila')->default(0);
                $table->integer('wine')->default(0);
                $table->integer('vodka')->default(0);
                $table->integer('absinthe')->default(0);
                $table->integer('rum')->default(0);
                $table->integer('whiskey')->default(0);
                $table->integer('zombie')->default(0);
                $table->integer('arena')->default(0);
                $table->integer('arenaPizza')->default(0);
                $table->integer('lunchSpecial')->default(0);
                $table->integer('fullPie')->default(0);
                $table->integer('happyHour')->default(0);
                $table->integer('mexicanWave')->default(0);
                $table->integer('finalCost')->default(0);
                $table->string('specialJson')->default(0);
                $table->tinyInteger('deleted')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arcadeSales');
    }
};
