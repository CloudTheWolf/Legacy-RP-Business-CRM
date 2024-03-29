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
        if(!Schema::hasTable('storageLog')) {
            Schema::create('storageLog', function (Blueprint $table) {
                $table->id();
                $table->integer('storageId');
                $table->integer('scrap');
                $table->integer('aluminium');
                $table->integer('steel');
                $table->integer('glass');
                $table->integer('rubber');
                $table->integer('issuer');
                $table->integer('issuedTo');
                $table->timestamp('tstamp')->useCurrent();
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
        Schema::dropIfExists('storageLog');
    }
};
