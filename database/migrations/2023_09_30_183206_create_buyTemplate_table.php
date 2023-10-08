<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('buyTemplate')) {
            Schema::create('buyTemplate', function (Blueprint $table) {
                $table->integer('userId')->unique('userId');
                $table->integer('scrap')->default(0);
                $table->integer('alum')->default(0);
                $table->integer('steel')->default(0);
                $table->integer('glass')->default(0);
                $table->integer('rubber')->default(0);
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
        Schema::dropIfExists('buyTemplate');
    }
}
