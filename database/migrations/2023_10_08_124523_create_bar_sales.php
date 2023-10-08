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
        if(!Schema::hasTable('barSale')){
            Schema::create('barSales', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->integer('staff');
                $table->integer('beer')->default(0);
                $table->integer('cider')->default(0);
                $table->integer('tequila')->default(0);
                $table->integer('wine')->default(0);
                $table->integer('vodka')->default(0);
                $table->integer('absinthe')->default(0);
                $table->integer('rum')->default(0);
                $table->integer('whiskey')->default(0);
                $table->integer('oiler')->default(0);
                $table->string('specialJson',2500)->nullable()->default(null);
                $table->integer('finalCost')->default(0);
                $table->tinyInteger('deleted')->default(0);
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barSales');
    }
};
