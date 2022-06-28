<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('discord', 100);
            $table->string('steam');
            $table->integer('cid');
            $table->string('cell', 8);
            $table->string('about');
            $table->string('why');
            $table->string('record');
            $table->boolean('gang');
            $table->timestamp('timestamp')->useCurrent();
            $table->integer('state')->default(0);
        });
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
};
