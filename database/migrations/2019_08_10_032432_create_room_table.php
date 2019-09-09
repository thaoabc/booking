<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room',function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->bigInteger('cate_id')->unsigned();
            $table->foreign('cate_id')
                ->references('id')
                ->on('cate_room')
                ->onDelete('cascade');
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
        Schema::dropIfExists('room');
    }
}
