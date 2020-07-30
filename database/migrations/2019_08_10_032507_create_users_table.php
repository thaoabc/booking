<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users',function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name_user');
            $table->string('email');
            $table->string('phone');
            $table->string('password')-> nullable();
            $table->string('identity_card');
            $table ->string('password_reminder_token', 100) -> nullable();
            $table->integer('status');
            $table->timestamps();
        });
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
