<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique('users_email_unique');
                $table->string('cell', 9);
                $table->string('towID')->nullable();
                $table->string('role', 100)->default('');
                $table->string('workingAs', 100)->default('');
                $table->timestamp('email_verified_at')->default('current_timestamp()');
                $table->string('password');
                $table->rememberToken();
                $table->timestamps()->default('current_timestamp()');
                $table->boolean('onDuty')->default(0);
                $table->integer('cid')->nullable();
                $table->string('steamId', 100)->nullable();
                $table->boolean('IsAdmin')->default(0);
                $table->boolean('disabled')->default(0);
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
        Schema::dropIfExists('users');
    }
}
