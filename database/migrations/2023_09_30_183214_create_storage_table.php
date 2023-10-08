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
        if(!Schema::hasTable('storage')) {
            Schema::create('storage', function (Blueprint $table) {
                $table->integer('id')->primary();
                $table->string('name');
                $table->integer('capacity');
                $table->integer('scrap');
                $table->integer('aluminium');
                $table->integer('steel');
                $table->integer('glass');
                $table->integer('rubber');
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
        Schema::dropIfExists('storage');
    }
};
