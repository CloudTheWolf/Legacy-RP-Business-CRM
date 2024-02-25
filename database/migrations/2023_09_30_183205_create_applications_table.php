<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('applications')) {
            Schema::create('applications', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('discord', 100);
                $table->string('steam');
                $table->integer('cid');
                $table->string('cell', 8);
                $table->string('about');
                $table->string('why');
                $table->string('record');
                $table->tinyInteger('gang');
                $table->timestamp('timestamp')->useCurrent();
                $table->integer('state')->default(0);
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
        Schema::dropIfExists('applications');
    }
}
